<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Classroom;
use App\Models\Subjects;
use App\Models\Messages;
use App\Models\User;
use App\Models\UserHistory;
use App\Models\ClassroomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\InputValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;

class ClassroomController extends Controller
{

    use InputValidator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $table = 'classrooms';
    protected $prefix = 'classrooms';



    public function index()
    {
        // search for registered classrooms:
        $linkedRooms = ClassroomUser::where('user_id', auth()->id())->get()->pluck("classroom_id");
        // fetch personal created classrooms:
        $classrooms = DB::table('classrooms')->whereIn('id',$linkedRooms)->paginate(8);

        return view($this->prefix . '.classroom-overview', compact('classrooms'));
    }

    public function getCurrentClassroom($classroom_id){
       return $classrooms = DB::table('classrooms')->where('id','=', $classroom_id)->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input data:
        $this->validateInput($request);
        $classroom = new Classroom();

        $classroom->name = request('cr-name');
        $classroom->created_by = Auth::user()->name;
        // fetch user id:
        $userID = auth()->id();
        $classroom->fk_user_id = $userID;
        // generate invitation link
        $classroom->invitation_link = $classroom->generateInvitationURL($classroom->id);
        // Store data:
        $classroom->save();
        $referenced_room = DB::table('classrooms')->latest()->first();
        $this->addToClassroom($userID, $referenced_room->id, false);

        // return to home index action:
        return redirect()->action([ClassroomController::class, 'show'], ['classroom' => $classroom]);
    }

    /**
     * @info: Visitors/Members that are redirected from
     *  "community/visit" will be handled in this function:
     */
    public function visitRoom($classroom_id)
    {
        $referredRoom = $this->getCurrentClassroom($classroom_id);
        $user = Auth()->id();

        // add user to classroom:
        if($referredRoom->is_public){
            $this->addToClassroom($user, $classroom_id, false);
        }

        return redirect()->action([ClassroomController::class, 'show'], ['classroom' => $classroom_id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {

        // Deny visits for unauthorized users:
        if(!$this->checkPermissions($classroom->id)){
            return redirect()->action([ClassroomController::class, 'index']);
        }

        // Add visit to history:
        $currentUser = auth()->id();
        $page_visited = $classroom->name;
        $timestamp = Carbon::now()->format('Y-m-d-H');
        $url = '/classrooms/' . $classroom->id;
        $popup = false;

        // check if user has any registered history for the referred classroom:
        if($this->notifyUser($currentUser, $url)){
            $popup = true; 
        }

        $userController = new UserController();
        $userController->registerVisit($currentUser, $classroom->id, $page_visited, $url, $timestamp);
        $linked_subjects = $this->getChildSubjects($classroom->id);

        // get user role:
        $user_role = $this->getUserRole($currentUser, $classroom->id);

        $adminName = User::where('id', $classroom->fk_user_id)->first()->name;
        return view('classrooms.view-classroom', compact('classroom', 'adminName', 'user_role', 'linked_subjects', 'popup'));
    }


    /**
     * @function: Returns the permission type for the referred user
     * @return: The permission type of the authenticated user:
     */
    public function getUserRole($user_id, $classroom_id)
    {

        $currentUser = ClassroomUser::where([
            ['user_id', '=', $user_id],
            ['classroom_id', '=', $classroom_id]
            ]
            )->first();

        return $currentUser->role;
    }

    /**
     * @function: check if user has permission to the designated classroom:
     */
    public function checkPermissions($classroom_id)
    {
        $linked_users = $this->getLinkedUsers($classroom_id)->pluck('id')->all();
        $currentUser = auth()->id();

        // Deny visits for unauthorized users:
        if(!in_array($currentUser, $linked_users)){
            // Return back to dashboard:
            return false;
        }

        return true;
    }


    /**
     * Update the specified resource in storage.
     *@param  \App\Models\Classroom $classroom_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($classroom_id, Request $request)
    {
        $updateValues = [];

        $this->validateInput($request);
        $postValues = $request->all();

        // remove unnecessary elements:
        unset($postValues['_token'], $postValues['_method']);

        // order is based on input location:
        $keys = ["cr_bio", "cr_name", "cr_publicity", "invitation_link"];
        $tableNames = ["bio", "name", "is_public", "invitation_link"];

        // fill the update array based on given update values:
        foreach ($keys as $idx => $key){

            // allow field to update if key is posted but value is empty:
            // else check if field is set then add to update:
            if(array_key_exists($key, $postValues) || isset($postValues[$key])){
                $updateValues[$tableNames[$idx]] = $postValues[$key];
            }
        }

        Classroom::where('id', $classroom_id)
            ->update($updateValues);

        return redirect()->action([ClassroomController::class, 'show'], ['classroom' => $classroom_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $classroom_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($classroom_id)
    {
        Classroom::where('id',$classroom_id)->delete();
        return redirect()->action([ClassroomController::class, 'index']);
    }


    /**
     * Displays classroom chat view:
     */
    public function updateChat($classroom_id)
    {
        $messages = [];

        $messages = Messages::where('classroom_id', $classroom_id)->get();

        if(!filled($messages)){
            return 'No messages';
        }

        return $messages;
    }

    public function getChildSubjects($cr_id){
        return Subjects::where('fk_classroom_id', $cr_id)->get();
    }

    public function getLinkedUsers($cr_id){

        $linkedIDs = ClassroomUser::where('classroom_id', $cr_id)->get();
        // Fetches the ids from the dataset:
        $plucked = $linkedIDs->pluck('user_id')->all();
        return User::whereIn('id', $plucked)->get();
    }

    /**
     * @function: Returns true if user makes his first classroom visit:
     **/
    public function notifyUser($user_id, $url){

        $firstVisit = !filled(UserHistory::where([
            ['page_url', '=', $url],
            ['fk_user_id', '=', $user_id]
            ])->first());

        return $firstVisit;
    }


      /**
       * @function: Add given users to their respective classroom.
       **/
    protected function addToClassroom($user_id, $classroom_id, $customInvite)
    {
        // Link user to classroom:
        $linkClassroom = new ClassroomUser();

        $classroomExists = ClassroomUser::where('classroom_id', $classroom_id)->get()->count();
        $is_registered = ClassroomUser::where([
            ['classroom_id', '=', $classroom_id],
            ['user_id', '=', $user_id]
            ])->first();

        // if there are no members, give creator admin rights:
        if(!$classroomExists){
            $linkClassroom->is_admin = true;
            $linkClassroom->user_id = $user_id;
            $linkClassroom->classroom_id = $classroom_id;
            $linkClassroom->role = 'admin';
            // Store data:
            $linkClassroom->save();
            // updateClassroomCount
            $this->updateMemberCount($classroom_id);
        }

        // if classroom already exists & member is not registered:
        if($classroomExists && !$is_registered){
                $role = ($customInvite) ? 'user' : 'spectator';
                $linkClassroom->is_admin = false;
                $linkClassroom->user_id = $user_id;
                $linkClassroom->classroom_id = $classroom_id;
                $linkClassroom->role = $role;
                // Store data:
                $linkClassroom->save();
                // updateClassroomCount
                $this->updateMemberCount($classroom_id);
            }

        // after all is set and done, just return:
        return redirect()->action([ClassroomController::class, 'show'], ['classroom' => $classroom_id]);
    }

    /**
     * @param: referenced Classroom id;
     * Update member count for classrooms
     **/
    public function updateMemberCount($classroom_id){
        $memberCount = ClassroomUser::where('classroom_id', '=', $classroom_id)->count();
        Classroom::where('id', $classroom_id)
            ->update(['member_count' => $memberCount]);
    }

    /**
     * Links users to their respective classrooms.
     **/
    public function linkToClassroom($token){

        $linkedRoom = $this->verifyInviteToken($token);
        // if verified:
        if(is_numeric($linkedRoom)){
            // if user is logged in:
            if(Auth::check()){
                $classroom_id = $linkedRoom;
                $currentUser = auth()->id();

                $this->addToClassroom($currentUser, $classroom_id, true);
                return redirect()->action([ClassroomController::class, 'show'], ['classroom' => $classroom_id]);
            }
        }

        // if !exists:
        return redirect()->action([ClassroomController::class, 'index']);
    }

    public function verifyInviteToken($token){
        $searchForToken = Classroom::where('invitation_link', 'like', '%' . $token . '%')->first();
          // if token is valid:
            if(filled($searchForToken)){
                return $searchForToken->id;
            }
        return false; 
    }


    public function searchClassrooms(Request $request)
    {
        if($request->ajax()){

            $linkedRooms = ClassroomUser::where('user_id', '=', auth()->id())->pluck('classroom_id');
            $classrooms = Classroom::where('name', 'like', '%' . $request->get('searchRequest') . '%')->whereIn('id', $linkedRooms)->get();

            if((strlen($request->searchRequest) <= 1) || (empty($request->searchRequest))){
                $classrooms = Classroom::where('name', 'like', '%' . $request->get('searchRequest') . '%')->whereIn('id', $linkedRooms)->paginate(8);
            }

            $output = '';

                if(count($classrooms) > 0 ) {

                    foreach($classrooms as $card){

                        $output .= (view('vendor/jetstream/components/info-card',
                            ['card_type' => 'st-card--classroom', 'noRedirect' => false, 'id' => $card->id, 'url' => 'classrooms.show', 'title' => $card->name,
                                'description' => $card->bio, 'createdBy' => $card->created_by, 'memberCount' => $card->member_count]))->render();
                    }

                    //blade
                    $lastCard = (view('vendor/jetstream/components/card-submit')->render());
                    $output .= $lastCard;
                }

                else{
                    $output = "No results..";
                }
            }

        return $output;
    }

}
