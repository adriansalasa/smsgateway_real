<?php

namespace App\Http\Controllers;

use App\user_get;
use App\buycredit;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class confirmcontroller extends Controller
{
    public function index()    
    {
               
    	return view('/admin.topup/confirm');
    }
    
    public function create()
    {

    }

    public function store(Request $request)
    {
    	// buycredit::create([
    	// 	'nomor_tagihan' => $request->noBill,
    	// 	'nominal' => $request->isiHrgDb,
    	// 	'idUser' => "3",
    	// 	'noRek' => $request->noRekv,
    	// 	'nmRek' => $request->namaRek,
    	// 	'createUser' => "System",
    	// 	'confirmYn' => "N" ]);
    	$nowTime = time();
		$timeHour= date("Y-m-d H:i:s"); 
		// return $timeHour;
    	DB::table('Playsms_BuyCredit')->insert([
    		'nomor_tagihan' =>  $request->noBill,
    		'nominal' =>  $request->isiHrgDb,
    		'idUser' =>  Auth::user()->uid,
    		'noRek' =>  $request->noRekv,
    		'nmRek' =>  $request->namaRek,
            'noTelp' => $request->isi_Tlp,
    		'createUser' => Auth::user()->uid,
    		'confirmYn' => "N",
    	]);    	

    	// DB::table('playsms_featureCredit')->insert([
    		
    	// 	'c_timestamp' =>  $nowTime,
    	// 	'parent_uid' =>  0,
    	// 	'uid' =>  "3",
    	// 	'username' => "agus",    		
    	// 	'status' => "3",    		
    	// 	'amount' => $request->isiHrgDb,
    	// 	'balance' => 0,
    	// 	'create_datetime' => $timeHour,
    	// 	'delete_datetime' => "",
    	// 	'flag_deleted' => 0
    	// ]);  
    	
    	return redirect('/topup')->with('status', 'Pembelian paket segera dikonfirmasi admin!');    	 
    }

    public function update(Request $request, user_get $user_get)
    {
        
    }

    public function destroy(buycredit $buycredit)
    {
    }
}
