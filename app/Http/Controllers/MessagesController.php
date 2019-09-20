<?php

namespace App\Http\Controllers;

use Auth;
use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function compose()
    {
        $template = DB::table('playsms_featureMsgtemplate')
            ->where('uid','=', Auth::user()->uid)
            ->get();

        return view('admin.message.compose', compact('template'));
    }

    public function send_sms(request $request) 
    {
        // echo 'nomor :'.$request->p_num_text.'<br>';
        // echo 'pesan :'.$request->message.'<br>';
        // echo 'check schedule :'.$request->schedule_check.'<br>';
        // echo 'date schedule :'.$request->schedule_date.'<br>';
        // echo 'footer :'.$request->sms_footer.'<br>';
        // echo 'flash sms :'.$request->checkFlashsms.'<br>';
        // echo 'Unicode sms :'.$request->checkUnicodesms.'<br>';
        if($request->schedule_check=='on'){
            $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=pv&to='.$request->p_num_text.'&msg='.$request->message.'&footer='.$request->sms_footer.'&schedule='.$request->schedule_date);
        }else{
            $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=pv&to='.$request->p_num_text.'&msg='.$request->message.'&footer='.$request->sms_footer);
        }

         return redirect(route('admin.inbox'))->with('status', $data);

        // $postdata = http_build_query(
        //     array(
        //         'app' => 'ws',
        //         'u' => Auth::user()->username,
        //         'h' => Auth::user()->token,
        //         'op' => 'pv',
        //         'to' => $request->p_num_text,
        //         'msg' => $request->message,
        //         'footer' => $request->sms_footer,
        //     )
        // );
        
        // $opts = array('http' =>
        //     array(
        //         'method'  => 'POST',
        //         'header'  => 'Content-Type: application/x-www-form-urlencoded',
        //         'content' => $postdata
        //     )
        // );
        
        // $context  = stream_context_create($opts);
        
        // $result = file_get_contents('http://192.168.5.31/index.php', false, $context);

        
    }

    public function api_getcontact(request $request) 
    {
        // echo $request->app;
        if(substr($request->kwd,0,1) == '#'){
            $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=get_contact_group&kwd='.substr($request->kwd,1));
        }else{
            $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=get_contact&kwd='.$request->kwd);
        }

        $jData = json_decode($data, JSON_PRETTY_PRINT);

        // $data_arr=array();
        for($i=0; $i < count($jData['data']); $i++){
            if(substr($request->kwd,0,1) != '#'){
                $data_arr[]= array(
                    "id"=>$jData['data'][$i]['p_num'],
                    "text"=>$jData['data'][$i]['p_desc'] ."(". $jData['data'][$i]['p_num'].")"
                );
            }else{
                $data_arr[]= array(
                    "id"=>'%23'.$jData['data'][$i]['code'],
                    "text"=>$jData['data'][$i]['group_name'] ."(". $jData['data'][$i]['code'].")"
                );
            }
        }
        // var_dump($jData);
        echo json_encode($data_arr, JSON_PRETTY_PRINT);
    }

    public function edit(Inbox $message){
        $template = DB::table('playsms_featureMsgtemplate')
            ->where('uid','=', Auth::user()->uid)
            ->get();
        return view('admin.message.replay', compact('message','template'));
    }
    
}
