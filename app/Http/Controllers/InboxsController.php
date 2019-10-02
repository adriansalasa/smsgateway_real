<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;


class InboxsController extends Controller
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

            $Inboxs = Inbox::where('in_uid', '=', Auth::user()->uid)
                ->whereRaw('(in_sender like "%'.$request->keyword.'%" OR in_msg like "%'.$request->keyword.'%" )')
                ->orderBY('in_id', 'DESC')
                ->paginate($request->total); 
            // $Inboxs->appends($request->only('keyword'));
            // $Inboxs->appends($request->only('total'));

            return view('admin.inbox.index', compact('Inboxs', 'request'));
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
    public function view($id)
    {
        $update = Inbox::where('in_id', $id)
            ->update([
               'read_status' => '1'
            ]);
        $data = Inbox::where('in_id', $id)->first();
        return view('admin.inbox.view', compact('data','id'));
    }

    public function read($id)
    {
        $update = Inbox::where('in_uid', $id)
            ->update([
               'read_status' => '1'
            ]);
        return redirect(route('admin.inbox'))->with('status', 'Pesan telah dibaca semua');
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
    public function destroy(Inbox $inbox)
    {
        Inbox::destroy($inbox->in_id);
        return redirect(route('admin.inbox'))->with('status', 'Pesan berhasil dihapus');
    }

    public function deletes(Request $request){
        $Inboxs_id_array = $request->input('id');

        $Inbox = Inbox::whereIn('in_id', $Inboxs_id_array);
        if($Inbox->delete())
        {
            echo 'Data berhasil dihapus';
        }
    }
}
