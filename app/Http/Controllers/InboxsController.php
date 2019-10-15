<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;
use PDF;


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

    public function printPDF($id)
    {
       //This  $data array will be passed to our PDF blade
       // $data = [
       //    'title' => 'First PDF for Medium',
       //    'heading' => 'Invoice',
       //    'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged'];

        $data = ['title' => 'Test Download PDF'];
        
        // $pdf = PDF::loadView('printPDF', $data);  
          $pdf = PDF::loadView('admin.inbox.printPDF', $data);  
        return $pdf->download('Bill_Paket.pdf');        
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
