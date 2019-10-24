<?php

namespace App\Http\Controllers;

use App\buycredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pay_verify_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pay_verify.index');
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
    public function store(Request $request, buycredit $buycredit)
    {

        $request->validate([
            'rek_BuyerEx' => 'required',
            'rNm_BuyerEx' => 'required'
        ]);
                
        // buycredit::where('nomor_tagihan', $request->Hid_kdBooking)
        //          ->update([
        //             'paidYn' => 'Y'
        //          ]);    
       
         DB::table('Playsms_BuyCredit')->where('nomor_tagihan',$request->Hid_kdBooking)->update([
        'paidYn' => 'Y', 'nrek_pembeli' => $request->rek_BuyerEx, 'nmrek_pembeli' => $request->rNm_BuyerEx
        ]);                     

        return redirect(route('admin.pay_verify'))->with('status', 'Paket anda segera dikonfirmasi admin..!');               
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request)
    {   
        $request->validate([
          'kdBooking' => 'required'  
        ]);     
        $CCredits = buycredit::all()->where('nomor_tagihan', $request->kdBooking)->where('paidYn', 'N')->first();            

        if(is_null($CCredits))
        {
            return view('admin.pay_verify.index'); 
        }else{            
            return view('admin.pay_verify.exist', ['CCredits' => $CCredits]);                            
        }
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
    public function update(Request $request, buycredit $buycredit)
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
