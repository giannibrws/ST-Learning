<?php

namespace App\Http\Controllers;


use App\Http\Controllers\UserHistoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{

    protected $table = 'users';

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registerVisit($user_id, $pageName, $timestamp)
    {
        $visited = new Request([
            'user_id'   => $user_id,
            'pageName' => $pageName,
            'created_at' => $timestamp,
        ]);

        $userHistory = new UserHistoryController();
        $userHistory->updateVisited($visited);
    }

    public function getDefaultProfilePhotoUrl()
    {
        $currentUserName = DB::table($this->table)->where('id', '=', auth()->id())->first()->name;
        return 'https://ui-avatars.com/api/?name='.urlencode($currentUserName).'&color=7F9CF5&background=EBF4FF';
    }

    public function getUserProfilePicture()
    {
       return Auth::user()->profile_photo_url;
    }

}
