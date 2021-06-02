<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\Classroom;
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
        // fetch all data
        $classrooms = DB::table('notes')->paginate(3);
        return view($this->prefix . 'view-note', compact('classrooms'));
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
        //
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
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
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
