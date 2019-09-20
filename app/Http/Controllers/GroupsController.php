<?php

namespace App\Http\Controllers;

use Auth;
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
        return view('kontak.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        Group::create([
            'uid' => Session::get('uid'),
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect('/group')->with('status', 'Group berhasil ditambahkan');
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
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
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
        DB::table('playsms_featurePhonebook_group')->where('id',$id)->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect('/group')->with('status', 'group berhasil diubah');
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
        return redirect('/group')->with('status', 'group berhasil dihapus');
    }

    protected function deletes(Request $request)
    {
        // return route('logins');
        $Groups_id_array = $request->input('id');

        $Group = Group::whereIn('id', $Groups_id_array);
        if($Group->delete())
        {
            echo 'Groups berhasil dihapus';
        }
    }
}
