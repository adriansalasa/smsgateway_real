<?php

namespace App\Http\Controllers;

use App\buycredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class paymentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sisaKredit = DB::table('Playsms_BuyCredit')->max('idTagihan');                         
        return view('/admin.topup.payment', compact('sisaKredit'));                
        // return 'kesini ajah';
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
     * @param  \App\buycredit  $buycredit
     * @return \Illuminate\Http\Response
     */
    public function show(buycredit $buycredit)
    {
        return view('/admin.topup.payment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\buycredit  $buycredit
     * @return \Illuminate\Http\Response
     */
    public function edit(buycredit $buycredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\buycredit  $buycredit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buycredit $buycredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\buycredit  $buycredit
     * @return \Illuminate\Http\Response
     */
    public function destroy(buycredit $buycredit)
    {
        //
    }
}
