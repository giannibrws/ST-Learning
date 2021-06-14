<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\User;
use App\Models\Notes;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Traits\InputValidator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubjectsController extends Controller
{

    use InputValidator;

    protected $table = 'subjects';
    protected $prefix = 'subjects.';

    /**
     * Display a listing of the resource
     * @info Only show route will be used for subjects
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store($classroom_id, Request $request)
    {

        // Validate input data:
        $this->validateInput($request);

        $subject = new Subjects();
        $subject->name = request('sub_name');
        // fetch user id:
        $subject->fk_user_id = auth()->id();
        $subject->fk_classroom_id = $classroom_id;
        // Store data:
        $subject->save();

        // Show the created resource;
        return redirect()->action([SubjectsController::class, 'show'], ['classroom_id' => $subject->fk_classroom_id, 'subject' =>  $subject]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Classroom  $classroom_id
     * @param  \App\Models\Subjects  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($classroom_id, Subjects $subject)
    {
        // Deny visits for unauthorized users:
        $c = new ClassroomController();

        if(!$c->checkPermissions($classroom_id)){
            return redirect()->action([ClassroomController::class, 'index']);
        }

        // general settings:
        $is_child_page = true;
        $parent_page_name = Classroom::where('id', $subject->fk_classroom_id)->first()->name;

        // Add visit to history:
        $currentUser = auth()->id();
        $page_visited = $parent_page_name . ' / ' . $subject->name;
        $timestamp = Carbon::now()->format('Y-m-d-H');
        $url = '/classrooms/' . $subject->fk_classroom_id . '/subjects/' .$subject->id;
        $userController = new UserController();
        $userController->registerVisit($currentUser, $page_visited, $url, $timestamp);

        // fetch display data:
        $adminName = User::where('id', $subject->fk_user_id)->first()->name;
        $subject_notes = $this->getSubjectNotes($subject->id);

        // remove html code from ckeditor:
        $this->removeHtmlAttrs($subject_notes);

        return view($this->prefix . 'view-subject', compact('subject','adminName', 'is_child_page', 'parent_page_name', 'subject_notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Models\Classrooms $classroom_id
     * @param  \App\Models\Subjects $subject_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($classroom_id, $subject_id, Request $request)
    {
        $updateValues = [];

        $this->validateInput($request);
        $postValues = $request->all();

        // remove unnecessary elements:
        unset($postValues['_token'], $postValues['_method']);

        // order is based on input location:
        $keys = ["sub_bio", "sub_name"];
        $tableNames = ["bio", "name"];

        // fill the update array based on given update values:
        foreach ($keys as $idx => $key){
            // allow field to update if key is posted but value is empty:
            // else check if field is set then add to update:
            if(array_key_exists($key, $postValues) || isset($postValues[$key])){
                $updateValues[$tableNames[$idx]] = $postValues[$key];
            }
        }

        Subjects::where('id', $subject_id)
            ->update($updateValues);

        $classroom_id = Subjects::where('id', $subject_id)->first()->fk_classroom_id;
        $subject = Subjects::where('id', $subject_id)->first();

        return redirect()->action([SubjectsController::class, 'show'], ['classroom_id' => $classroom_id, 'subject' => $subject]);
    }

    /**
     * Remove the specified resource from storage.
     *@param  \App\Models\ $classroom
     * @param  \App\Models\ $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($classroom_id,  $subject_id)
    {
        Subjects::where('id',$subject_id)->delete();
        return redirect()->action([ClassroomController::class, 'show'], ['classroom' => $classroom_id]);
    }

    public function getSubjectNotes($subject_id)
    {
        return DB::table('notes')->where('fk_subject_id', $subject_id)->paginate(20);
    }

    /* Clears html from preview: */
    public function removeHtmlAttrs($contents){
        $j = 0;
        foreach ($contents as $note){
            $contents[$j]->content = html_entity_decode($note->content);
            $contents[$j]->content = strip_tags($note->content);
            $contents[$j]->content = str_ireplace('&nbsp;', '', $note->content);
            $j++;
        }
    }

}
