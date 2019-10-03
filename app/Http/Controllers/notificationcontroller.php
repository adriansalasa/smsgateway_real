<?php

namespace App\Http\Controllers;

use App\notifdata;
use App\buycredit;
use Auth;
use App\user_get;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class notificationcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifdb = notifdata::where('confirmYn', 'N')
                    ->get();
         return view('admin.notification.index', compact('notifdb'));
        // return $notifdata;
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
     * @param  \App\notifdata  $notifdata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
         $notifDet = notifdata::where('idTagihan', $id)->first();                    
        // return $deReq;
         return view('admin.notification.view', compact('notifDet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\notifdata  $notifdata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\notifdata  $notifdata
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {     
         
        $nowTime = time();
        $timeHour= date("Y-m-d H:i:s");         

        $FCredits = DB::table('Playsms_BuyCredit')->where('idTagihan', $id)->get();        
        foreach($FCredits as $FCredit){     

            $jmlAmount = $FCredit->nominal;
            $userID = $FCredit->idUser;                                         
        } 


        $users = DB::table('playsms_tblUser')->where('uid', $userID)->get();               
        foreach($users as $user){  
            $usrStatus = $user->status;
            $userNm = $user->username;
        }

        foreach($FCredits as $FCredit2){                                
            $insDB = DB::table('playsms_featureCredit')                                 
            ->insert([                                    
                    'c_timestamp' => $nowTime,
                    'parent_uid' => 0,
                    'uid'    =>  $userID,                    
                    'username' => $userNm,
                    'status'  => $usrStatus,
                    'amount'  => $jmlAmount,
                    'balance' => 0, 
                    'create_datetime' => $timeHour,
                    'delete_datetime' => '',
                    'flag_deleted' => 0   
                ]);            
        } 
                  
        $updatesData_id = $id;         

        $FCredits = DB::table('Playsms_BuyCredit')->where('idTagihan',$updatesData_id)->update([
        'confirmYn' => 'Y'
        ]);                                

        return redirect(route('admin.notification'))->with('status', 'Paket telah dikonfirmasi...!');
    }

     public function updates(Request $request)
    {         
          $nowTime = time();
          $timeHour= date("Y-m-d H:i:s");    

          $FCredits = DB::table('Playsms_BuyCredit')->where('confirmYn', 'N')->get();        
           foreach($FCredits as $FCredit){     

                $jmlAmount = $FCredit->nominal;
                $userID = $FCredit->idUser;                                         
            } 


            $users = DB::table('playsms_tblUser')->where('uid', $userID)->get();               
            foreach($users as $user){  
                $usrStatus = $user->status;
                $userNm = $user->username;
            }

            foreach($FCredits as $FCredit2){                                
                $insDB = DB::table('playsms_featureCredit')                                 
                ->insert([                                    
                        'c_timestamp' => $nowTime,
                        'parent_uid' => 0,
                        'uid'    =>  $userID,                    
                        'username' => $userNm,
                        'status'  => $usrStatus,
                        'amount'  => $jmlAmount,
                        'balance' => 0, 
                        'create_datetime' => $timeHour,
                        'delete_datetime' => '',
                        'flag_deleted' => 0   
                    ]);            
            } 
                  
            $updatesData_id_array = $request->input('id');         
         
            $FCredits = DB::table('Playsms_BuyCredit')->whereIn('idTagihan',$updatesData_id_array)->update([
            'confirmYn' => 'Y'
            ]);                  
            echo 'Paket telah dikonfirmasi...!';
    }

     public function deletes(Request $request){  
        $delete_id_array = $request->input('id');
        
        // DB::table('Playsms_BuyCredit')->wherein('idTagihan',$delete_id_array)->delete();     
        // echo 'Paket telah ditolak...!';

        $delCred = buycredit::whereIn('idTagihan', $delete_id_array);
        if($delCred->delete())
        {
            echo 'Paket telah ditolak';
        }        
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notifdata  $notifdata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'hapus ya';
        DB::table('Playsms_BuyCredit')->where('idTagihan',$id)->delete();     
        return redirect(route('admin.notification'))->with('status', 'Paket telah direject...!');
    }
}