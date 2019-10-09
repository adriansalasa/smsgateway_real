<?php

namespace App\Http\Controllers;

use App\C_Paid;
use Illuminate\Http\Request;

class Con_Pack_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.notification.confPackage');
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
     * @param  \App\C_Paid  $c_Paid
     * @return \Illuminate\Http\Response
     */
    public function show(C_Paid $c_Paid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\C_Paid  $c_Paid
     * @return \Illuminate\Http\Response
     */
    public function edit(C_Paid $c_Paid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\C_Paid  $c_Paid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, C_Paid $c_Paid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\C_Paid  $c_Paid
     * @return \Illuminate\Http\Response
     */
    public function destroy(C_Paid $c_Paid)
    {
        //
    }
}
