<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use App\Models\User;
use App\Models\UserHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch all data
        $userManager = new UserController();
        $defaultPhotoPath = $userManager->getDefaultProfilePhotoUrl(auth()->id());
        $userProfilePath = $userManager->getUserProfilePicture();

        $userHistory = DB::table('user_histories')
            ->where('fk_user_id', '=', auth()->id())
            ->orderByDesc('created_at')->limit(10)->get();

        $currentUser = DB::table('users')
            ->where('id', '=', auth()->id())->first();

        return view('dashboard', compact('userHistory', 'currentUser', 'defaultPhotoPath', 'userProfilePath'));
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
}
