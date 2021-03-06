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
    
    	$nowTime = time();
		$timeHour= date("Y-m-d H:i:s"); 
        $hrgPaket = $request->isiHrgDb; 
        $tmpHour= date("md");  
        $tmpNomor = $request->noBill;
        $tmpNobill = $tmpHour . '' . $tmpNomor;           

        $cntBuy = buycredit::max('idTagihan');

        if(is_null($cntBuy) || $cntBuy === 0 )
        {
            $tmpNobill = $tmpNobill . '' . 0;   

            $tmpNobill = ((int)$tmpNobill) + 1 ;   

        }else{
            $tmpNobill = ((int)$tmpNobill) + 1 ;
        }

    	DB::table('Playsms_BuyCredit')->insert([
    		'nomor_tagihan' =>  $tmpNobill,
            'nama_paket' => $request->nmPaket,
    		'nominal' =>  $request->isiHrgDb,
    		'idUser' =>  Auth::user()->uid,
    		'noRek' =>  $request->noRekv,
    		'nmRek' =>  $request->namaRek,
            'noTelp' => $request->isi_Tlp,
    		'createUser' => Auth::user()->uid,
    		'confirmYn' => "N",
            'paidYn' => "N",
            'nm_ATM' => $request->lbl_TATM
    	]);    	

        DB::table('playsms_tblSMSInbox')->insert([
            'c_timestamp' =>  now()->timestamp,
            'flag_deleted' => 0,
            'in_sender' => '+myIM3',
            'in_receiver' =>  $request->isi_Tlp,
            'in_uid' =>  Auth::user()->uid,
            'in_msg' => "Pembelian Paket" . $request->nmPaket . ", klik Download untuk Cek Tagihan anda ",
            'in_datetime' => now(),
            'reference_id' => $tmpNobill,
            'read_status' => 0
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
        $msgToSend = "Pembelian Paket " . $request->nmPaket . "," . " Nomor Tagihan anda adalah " .$tmpNobill. "," . " Silahkan transfer ke rekening berikut:" . $request->noRekv . " A\N :" . $request->namaRek;
        $sms_footer = "Graha Mitra Teguh";
        $noTlp = "+6282298321921";

        $datas = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=pv&to='.$noTlp.'&msg='.$msgToSend.'&footer='.$sms_footer);

        $data = json_decode($datas, true);

        $result = [];
        foreach ($data['data'] as $item)
        {
            $result[] = $item['status'];
        }

        if(in_array("ERR", $result))
        {
            $result_no = array_count_values($result)["ERR"];
        }else{
            $result_no = 0;
        }

        $terkirim = count($result) - $result_no;
    	
        return redirect('/topup')->with('status', 'Segera Bayar Tagihan anda. Pesan terkirim' .$terkirim. 'dan Pesan Gagal' .$result_no );    	 
    }

    public function update(Request $request, user_get $user_get)
    {
        
    }

    public function destroy(buycredit $buycredit)
    {
    }
}
