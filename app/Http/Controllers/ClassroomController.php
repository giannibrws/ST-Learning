<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Classroom;
use App\Models\Subjects;
use App\Models\Messages;
use App\Models\User;
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
        $classrooms = DB::table('classrooms')->where('fk_user_id','=', auth()->id())
            ->orWhereIn('id', $linkedRooms)
            ->paginate(8);


        return view($this->prefix . '.classroom-overview', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $classroom->member_count = 1;
        // fetch user id:
        $userID = auth()->id();
        $classroom->fk_user_id = $userID;
        // Store data:
        $classroom->save();
        $referenced_room = DB::table('classrooms')->latest()->first();
        $this->linkClassroom($userID, $referenced_room->id);

        // return to home index action:
        return redirect()->action([ClassroomController::class, 'show'], $classroom);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        // Add visit to history:
        $currentUser = auth()->id();
        $page_visted = $classroom->name;
        $timestamp = Carbon::now()->format('Y-m-d-H');
        $url = '/classrooms/' . $classroom->id;

        $userController = new UserController();
        $userController->registerVisit($currentUser, $page_visted, $url, $timestamp);
        $linked_subjects = $this->getChildSubjects($classroom->id);
        $linked_users = $this->getLinkedUsers($classroom->id);
        $userProfilePhotos = [];

         // fetch all data
        $userManager = new UserController();

        foreach ($linked_users as $user){
            $defaultPhotoPath = $userManager->getDefaultProfilePhotoUrl($user->id);
            array_push($userProfilePhotos, $defaultPhotoPath);
        }

        $adminName = User::where('id', $classroom->fk_user_id)->first()->name;
        return view('classrooms.view-classroom', compact('classroom', 'adminName', 'linked_subjects', 'linked_users', 'userProfilePhotos'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classrooms
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classrooms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *@param  \App\Models\Classroom $classroom_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($classroom_id, Request $request)
    {
        $updateValues = $request->all();
        unset($updateValues['_token'], $updateValues['_method']);
        $this->validateInput($request);
        $classroom_bio = $updateValues['cr_bio'];

        Classroom::where('id', $classroom_id)
            ->update(['bio' => $classroom_bio]);

        return redirect()->action([ClassroomController::class, 'show'], $classroom_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classrooms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classrooms)
    {
        //
    }


    /**
     * Displays classroom chat view:
     */
    public function updateChat($classroom_id){

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
       * Links users to their respective classrooms.
       **/

    protected function linkClassroom($user_id, $classroom_id){
        // Link user to classroom:
        $linkClassroom = new ClassroomUser();
        $linkClassroom->user_id = $user_id;
        $linkClassroom->classroom_id = $classroom_id;

        $is_registered = ClassroomUser::where('id', $classroom_id)->get()->count();

        if(!$is_registered){
            $linkClassroom->is_admin = true;
        }
        
        // Store data:
        $linkClassroom->save();
    }


    public function searchClassrooms(Request $request)
    {

        if($request->ajax()){

            $classrooms = Classroom::where('name', 'like', '%' . $request->get('searchRequest') . '%')->get();

            if((strlen($request->searchRequest) <= 1) || (empty($request->searchRequest))){
                $classrooms = DB::table($this->table)->paginate(8);
            }

            $output = '';

                if(count($classrooms)>0){
                    foreach($classrooms as $card){
                        $output .= '<div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-8">
                            <a href="'.route("classrooms.show", $card->id).'">
                            <div class="flex items-center px-5 py-12 shadow-sm rounded-md bg-white hover:opacity-50">
                                <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                                    <svg class="h-12 w-12 text-white" viewBox="0 0 28 30" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                                fill="currentColor"></path>
                                        <path d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                                fill="currentColor"></path>
                                        <path d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                                fill="currentColor"></path>
                                        <path d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                                fill="currentColor"></path>
                                        <path d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                                fill="currentColor"></path>
                                        <path d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                                fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">'.$card->name.'</h4>
                                    <div class="text-gray-500">'.substr($card->bio,0,100) . "...".'</div>
                                </div>
                            </div>
                            </a>
                        </div>';
                    }

                    //blade
                    $lastCard = (view('vendor/jetstream/components/card-submit')->render());
                    $output .= $lastCard;

                }

                else{
                    $output = "<h3 class='text-center'>No results</h3>";
                }
        }

        return $output;
    }


}
