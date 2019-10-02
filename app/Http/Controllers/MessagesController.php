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
            $datas = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=pv&to='.$request->p_num_text.'&msg='.$request->message.'&footer='.$request->sms_footer.'&schedule='.$request->schedule_date);
        }else{
            $datas = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=pv&to='.$request->p_num_text.'&msg='.$request->message.'&footer='.$request->sms_footer);
        }
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

         return redirect(route('admin.outbox'))->with('status', 'Pesan terkirim '.$terkirim.' dan gagal '.$result_no);
         // return redirect(route('admin.outbox'))->with('status', $datas);

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

    public function test(){
        $data = json_decode('{"data":[{"status":"YES","error":"0","smslog_id":"3185","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62819683032"},{"status":"YES","error":"0","smslog_id":"3186","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62821111111"},{"status":"OK","error":"0","smslog_id":"3187","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62822667888"},{"status":"OK","error":"0","smslog_id":"3188","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62823000849"},{"status":"OK","error":"0","smslog_id":"3189","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62823456641"},{"status":"OK","error":"0","smslog_id":"3190","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62823698769"},{"status":"OK","error":"0","smslog_id":"3191","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62823862014"},{"status":"OK","error":"0","smslog_id":"3192","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62831826929"},{"status":"OK","error":"0","smslog_id":"3193","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62811578107"},{"status":"OK","error":"0","smslog_id":"3194","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62811731119"},{"status":"OK","error":"0","smslog_id":"3195","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812103612"},{"status":"OK","error":"0","smslog_id":"3196","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812223554"},{"status":"OK","error":"0","smslog_id":"3197","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812229988"},{"status":"OK","error":"0","smslog_id":"3198","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812456148"},{"status":"OK","error":"0","smslog_id":"3199","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812456589"},{"status":"OK","error":"0","smslog_id":"3200","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812615949"},{"status":"OK","error":"0","smslog_id":"3201","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62812777617"},{"status":"OK","error":"0","smslog_id":"3202","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62816386579"},{"status":"OK","error":"0","smslog_id":"3203","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62816433733"},{"status":"OK","error":"0","smslog_id":"3204","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62816665999"},{"status":"OK","error":"0","smslog_id":"3205","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817130385"},{"status":"OK","error":"0","smslog_id":"3206","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817221290"},{"status":"OK","error":"0","smslog_id":"3207","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817349307"},{"status":"OK","error":"0","smslog_id":"3208","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817535825"},{"status":"OK","error":"0","smslog_id":"3209","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817571764"},{"status":"OK","error":"0","smslog_id":"3210","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817620676"},{"status":"OK","error":"0","smslog_id":"3211","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817782739"},{"status":"OK","error":"0","smslog_id":"3212","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62817783739"},{"status":"OK","error":"0","smslog_id":"3213","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818225271"},{"status":"OK","error":"0","smslog_id":"3214","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818430804"},{"status":"ERR","error":"0","smslog_id":"3215","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818451252"},{"status":"OK","error":"0","smslog_id":"3216","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818451253"},{"status":"OK","error":"0","smslog_id":"3217","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818644400"},{"status":"OK","error":"0","smslog_id":"3218","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818644422"},{"status":"OK","error":"0","smslog_id":"3219","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818733569"},{"status":"OK","error":"0","smslog_id":"3220","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818772727"},{"status":"OK","error":"0","smslog_id":"3221","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62818811927"},{"status":"OK","error":"0","smslog_id":"3222","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62819307321"},{"status":"OK","error":"0","smslog_id":"3223","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62819430631"},{"status":"OK","error":"0","smslog_id":"3224","queue":"52fb0c87d1da476a4c6656637c9d58c3","to":"+62819676846"}],"error_string":null,"timestamp":1569394442}', true);

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
    return count($result) - $result_no;
    }
    
}
