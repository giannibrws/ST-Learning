<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $userHistory = new UserHistory();

        $userHistory->last_viewed = $request->pageName;
        $userHistory->fk_user_id = $request->user_id;

        $userHistory->save();
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\UserHistory  $userHistory
     * @return \Illuminate\Http\Response
     */
    public function show(UserHistory $userHistory)
    {
        //
    }

    public function updateVisited(Request $visited)
    {
        $this->store($visited);
    }


}
