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

        $note = new Notes();

        $note->name = "leave_blank";
        $note->content = request('content');
        // fetch user id:
        $note->fk_user_id = auth()->id();
        $note->fk_subject_id = request('subject_id');
        // Store data:
        $note->save();

        // return to home index action:
        return redirect()->action([NotesController::class, 'show'], $note);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notes  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $note)
    {

        $parent_page_name = Subjects::where('id', $note->fk_subject_id)->first()->name;
        $is_child_page = true;
        return view($this->prefix . 'view-note', compact('note', 'parent_page_name', 'is_child_page'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Notes  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $note)
    {
        $parent_page_name = Subjects::where('id', $note->fk_subject_id)->first()->name;
        $is_child_page = true;
        return view($this->prefix . 'edit-note', compact('note', 'parent_page_name', 'is_child_page'));
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

        return redirect()->action([SubjectsController::class, 'show'], $request->fk_subject_id);
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