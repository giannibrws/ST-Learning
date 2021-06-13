<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\Classroom;
use App\Http\Controllers\SubjectsController;
use App\Http\Traits\InputValidator;
use App\Models\Subjects;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    use InputValidator;

    protected $table = 'notes';
    protected $prefix = 'subjects.notes.';

    /**
     * Display a listing of the resource.
     *
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($classroom_id, $subject_id, Request $request)
    {

        $note = new Notes();

        $note->name = "Title";
        $note->content = '';
        // fetch user id:
        $note->fk_user_id = auth()->id();
        $note->fk_subject_id = $subject_id;
        // Store data:
        $note->save();

        // return to home index action:
        return redirect()->action([NotesController::class, 'edit'],
            ['classroom_id' => $classroom_id, 'subject_id' => $subject_id, 'note' => $note]);
    }


    /**
     * Show the form for editing the specified resource.
     * @info: ID's are needed for parameter routing
     * @param  \App\Models\Notes  $note ($id)
     * @return \Illuminate\Http\Response
     */
    public function edit($classroom_id, $subject_id, Notes $note)
    {
        // Deny visits for unauthorized users:
        $c = new ClassroomController();
        if(!$c->checkPermissions($classroom_id)){
            return redirect()->action([ClassroomController::class, 'index']);
        }

        $parent_page_name = Subjects::where('id', $note->fk_subject_id)->first()->name;
        $is_child_page = true;
        return view($this->prefix . 'edit-note', compact('note', 'parent_page_name', 'is_child_page', 'classroom_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($classroom_id, Request $request)
    {
        $this->validateInput($request);
        $updateValues = $request->all();
        unset($updateValues['_token'], $updateValues['_method']);
        $updateValues['name'] = 'Title';

        // if note contains headers:
        if(strpos($updateValues['content'] , '<h1>') !== false){
            // Find the first <h1> occurrence and bind its value to note->title
            preg_match('/<h1>(.*?)<\/h1>/s', $updateValues['content'], $title);
            // https://www.php.net/manual/en/function.preg-match.php
            $updateValues['name'] = $title[1];
            $updateValues['content'] = substr($updateValues['content'], strlen($title[0]));
        }

        Notes::where('id', $request->id)
            ->update($updateValues);

        // @todo: Fetch classroom id from Query

        return redirect()->action([SubjectsController::class, 'show'], ['classroom_id' => $classroom_id, 'subject' => $request->fk_subject_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notes  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($classroom_id, $subject_id, $note_id)
    {
        Notes::where('id',$note_id)->delete();
        return redirect()->action([SubjectsController::class, 'show'], ['classroom_id' => $classroom_id, 'subject' => $subject_id]);
    }

}
