<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\Classroom;
use App\Http\Controllers\SubjectsController;
use App\Models\Subjects;
use Illuminate\Http\Request;

class NotesController extends Controller
{

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
    public function update(Request $request)
    {
        $updateValues = $request->all();
        unset($updateValues['_token'], $updateValues['_method']);

//        $this->validateInput($request);
        Notes::where('id', $request->id)
            ->update($updateValues);

        // @todo: Fetch classroom id from Query

        return redirect()->action([SubjectsController::class, 'show'], ['classroom_id' => 1, 'subject' => $request->fk_subject_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
