<?php

namespace App\Http\Controllers;

use App\user_get;
use Illuminate\Http\Request;
use Auth;

class topupcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = user_get::all();        
        $user = user_get::where('uid', Auth::user()->uid )->first();
        return view('admin.topup.index', ['user_get' => $user]);                
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
     * @param  \App\user_get  $user_get
     * @return \Illuminate\Http\Response
     */
    public function show(user_get $user_get)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_get  $user_get
     * @return \Illuminate\Http\Response
     */
    public function edit(user_get $user_get)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_get  $user_get
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_get $user_get)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_get  $user_get
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_get $user_get)
    {
        //
    }
}
