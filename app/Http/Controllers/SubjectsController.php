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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $subject = new Subjects();
        $subject->name = request('sub_name');
        // fetch user id:
        $subject->fk_user_id = auth()->id();
        $subject->fk_classroom_id = request('cr_id');
        // Store data:
        $subject->save();

        // return to home index action:
        return redirect()->action([SubjectsController::class, 'show'], $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subjects  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $subject)
    {
        // Add visit to history:
        $currentUser = auth()->id();
        $page_visited = $subject->name;
        $timestamp = Carbon::now()->format('Y-m-d-H');

        $userController = new UserController();
        $userController->registerVisit($currentUser, $page_visited, $timestamp);

        $is_child_page = true;
        $parent_page_name = Classroom::where('id', $subject->fk_classroom_id)->first()->name;
        $adminName = User::where('id', $subject->fk_user_id)->first()->name;

        $subject_notes = $this->getSubjectNotes($subject->id);

        return view($this->prefix . 'view-subject', compact('subject', 'adminName', 'is_child_page', 'parent_page_name', 'subject_notes'));

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $subjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subjects)
    {
        //
    }

    public function getSubjectNotes($subject_id)
    {
        return DB::table('notes')->where('fk_subject_id', $subject_id)->paginate(10);
    }

}
