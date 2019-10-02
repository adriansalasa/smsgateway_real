<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->total)){$request->total = '20';}
            if(!isset($request->page)){$request->page = '1';}
            
            $groups = DB::table('playsms_featurePhonebook_group')
            ->LeftJoin('playsms_featurePhonebook_group_contacts', 'playsms_featurePhonebook_group.id', '=', 'playsms_featurePhonebook_group_contacts.gpid')
            ->select('playsms_featurePhonebook_group.*', DB::raw('count(playsms_featurePhonebook_group.id) as total'))->groupBy('playsms_featurePhonebook_group.id')
            ->where('playsms_featurePhonebook_group.uid', '=', Auth::user()->uid)
            ->whereRaw('(playsms_featurePhonebook_group.name like "%'.$request->keyword.'%" OR playsms_featurePhonebook_group.code like "%'.$request->keyword.'%")')
            ->paginate($request->total)
            ->appends($request->only('keyword'))
            ->appends($request->only('total'));

            return view('admin.kontak.group.index', compact('groups', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kontak.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idnya = Auth::user()->uid;

        $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        Group::create([
            'uid' => $idnya,
            'name' => $request->name,
            'code' => $request->code
        ]);

        // return view('admin.kontak.group.index')->with('status', 'Group berhasil ditambahkan');

        if(!isset($request->total)){$request->total = '20';}
            if(!isset($request->page)){$request->page = '1';}
            
            $groups = DB::table('playsms_featurePhonebook_group')
            ->LeftJoin('playsms_featurePhonebook_group_contacts', 'playsms_featurePhonebook_group.id', '=', 'playsms_featurePhonebook_group_contacts.gpid')
            ->select('playsms_featurePhonebook_group.*', DB::raw('count(playsms_featurePhonebook_group.id) as total'))->groupBy('playsms_featurePhonebook_group.id')
            ->where('playsms_featurePhonebook_group.uid', '=', Auth::user()->uid)
            ->whereRaw('(playsms_featurePhonebook_group.name like "%'.$request->keyword.'%" OR playsms_featurePhonebook_group.code like "%'.$request->keyword.'%")')
            ->paginate($request->total)
            ->appends($request->only('keyword'))
            ->appends($request->only('total'));

            return view('admin.kontak.group.index', compact('groups', 'request'));
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
    public function edit($group)
    {
        $detail = Group::where('id', $group)->first();
        return view('admin.kontak.group.edit', compact('detail','group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        DB::table('playsms_featurePhonebook_group')->where('id',$id)->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        if(!isset($request->total)){$request->total = '20';}
        if(!isset($request->page)){$request->page = '1';}
        
        $groups = DB::table('playsms_featurePhonebook_group')
        ->LeftJoin('playsms_featurePhonebook_group_contacts', 'playsms_featurePhonebook_group.id', '=', 'playsms_featurePhonebook_group_contacts.gpid')
        ->select('playsms_featurePhonebook_group.*', DB::raw('count(playsms_featurePhonebook_group.id) as total'))->groupBy('playsms_featurePhonebook_group.id')
        ->where('playsms_featurePhonebook_group.uid', '=', Auth::user()->uid)
        ->whereRaw('(playsms_featurePhonebook_group.name like "%'.$request->keyword.'%" OR playsms_featurePhonebook_group.code like "%'.$request->keyword.'%")')
        ->paginate($request->total)
        ->appends($request->only('keyword'))
        ->appends($request->only('total'));

        return redirect(route('admin.group'))->with('groups', 'request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        Group::destroy($group->id);
        return redirect(route('admin.group'))->with('status', 'Pesan berhasil dihapus');
    }

    public function deletes(Request $request){
        $Group_id_array = $request->input('id');

        $Group = Group::whereIn('id', $Group_id_array);
        if($Group->delete())
        {
            echo 'Data berhasil dihapus';
        }
    }
}
