<?php

namespace App\Http\Controllers;

use App\Outbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class OutboxsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->total)){$request->total = '10';}
        if(!isset($request->page)){$request->page = '1';}

            $Outboxs = Outbox::where('uid', '=', Auth::user()->uid)->orderBy('p_datetime', 'DESC')
                ->whereRaw('(p_dst like "%'.$request->keyword.'%" OR p_msg like "%'.$request->keyword.'%" )')
                ->paginate($request->total); 
            // $Inboxs->appends($request->only('keyword'));
            // $Inboxs->appends($request->only('total'));

            return view('admin.outbox.index', compact('Outboxs', 'request'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outbox $outbox)
    {
        Outbox::destroy($outbox->id);
        return redirect(route('admin.outbox'))->with('status', 'Outbox berhasil dihapus');
    }

    public function resend(outbox $outbox)
    {
        // var_dump($outbox);
        // echo 'nomor :'.$outbox->p_dst.'<br>';
        // echo 'pesan :'.$outbox->p_msg.'<br>';
        // echo 'footer :'.$outbox->p_footer.'<br>';

        $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Auth::user()->username.'&h='.Auth::user()->token.'&op=pv&to='.$outbox->p_dst.'&msg='.$outbox->p_msg.'&footer='.$outbox->p_footer);
        outbox::destroy($outbox->id);

         return redirect(route('admin.outbox'))->with('status', $data);
    }

    public function deletes(Request $request){
        $Outboxs_id_array = $request->input('id');

        $Outbox = Outbox::whereIn('id', $Outboxs_id_array);
        if($Outbox->delete())
        {
            echo 'Data berhasil dihapus';
        }
    }
}
