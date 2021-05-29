<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $table = 'classrooms';
    protected $prefix = 'classrooms';

    public function index()
    {
        // fetch all data
        $classRoomData = DB::table('classrooms')->get();

        return view($this->prefix . '.classroom-overview', compact('classRoomData'));
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
        $classroom->fk_user_id = '1';
        // Store data:
        $classroom->save();

        // return to home index action:
        return redirect()->action([ClassroomController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        dd('yo');

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classrooms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classrooms)
    {
        //
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


    private function validateInput(Request $request){

        foreach ($request->input() as $key => $field){
            if($key !== "_token" || $key !== "_method"){
                if($key == "content"){
                    $request->validate([$key => 'required|max:1000'],
                        [
                            $key . '.required' => 'Field ' . $key . ' is required',
                            $key . '.max' => 'Field ' . $key . ' is too long. Max 1000 characters allowed!',
                        ]);
                }
                else{
                    $request->validate([$key => 'required|max:255'],
                        [
                            $key . '.required' => 'Field ' . $key . ' is required',
                            $key . '.max' => 'Field ' . $key . ' is too long. Max 255 characters allowed!',
                        ]);
                }
            }
        }
    }




}
