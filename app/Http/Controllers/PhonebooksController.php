<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Phonebook_join_Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PhonebooksExport;
use Auth;

class PhonebooksController extends Controller
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

            $phone = DB::table('playsms_featurePhonebook')
                ->leftJoin('playsms_featurePhonebook_group_contacts', 'playsms_featurePhonebook.id', '=', 'playsms_featurePhonebook_group_contacts.pid')
                ->leftJoin('playsms_featurePhonebook_group', 'playsms_featurePhonebook_group_contacts.gpid', '=', 'playsms_featurePhonebook_group.id')
                ->select('playsms_featurePhonebook.*', 'playsms_featurePhonebook_group.name as nmGroup')
                ->where('playsms_featurePhonebook.uid', '=', Auth::user()->uid)
                ->whereRaw('(playsms_featurePhonebook.name like "%'.$request->keyword.'%" OR playsms_featurePhonebook.mobile like "%'.$request->keyword.'%" OR playsms_featurePhonebook_group.name like "%'.$request->keyword.'%")');

            $group = DB::table('playsms_featurePhonebook_group')
            ->where('uid','=', Auth::user()->uid)
            ->get();

            $Phonebooks = $phone->paginate($request->total); 
            $Phonebooks->appends($request->only('keyword'));
            $Phonebooks->appends($request->only('total'));
            return view('admin.kontak.phonebook.index', compact('Phonebooks', 'request', 'group'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = DB::table('playsms_featurePhonebook_group')
            ->where('uid','=', Auth::user()->uid)
            ->get();
        return view('admin.kontak.phonebook.create', compact('group'));
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
            'mobile' => 'required'
        ]);

        Phonebook::create([
            'uid' => Auth::user()->uid,
            'mobile' => $request->mobile,
            'name' => $request->name,
            'email' => $request->email,
            'tags' => $request->tags
        ]);

        $hasil = DB::table('playsms_featurePhonebook')->latest('created_at')->first();
   
        $PjG = DB::table('playsms_featurePhonebook_group_contacts')->insert(['pid'=>$hasil->id, 'gpid' => $request->gpid]);

        return redirect('/kontak/phonebook')->with('status', 'Kontak berhasil ditambahkan');
        // Update nanti kalau butuh multi group
        // $dataSet = [];
        // foreach ($request->gpid as $gpid){
        //     $dataSet[] = [
        //         'pid'  => $hasil->id,
        //         'gpid'    => $gpid
        //     ];
        // }

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
    public function edit(Phonebook $phonebook)
    {
        $group = DB::table('playsms_featurePhonebook_group')
            ->where('uid','=', Auth::user()->uid)
            ->get();

        return view('admin.kontak.phonebook.edit', compact('phonebook', 'group'));
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
        // var_dump($request->tags);
        DB::table('playsms_featurePhonebook')->where('id',$id)->update([
            'mobile' => $request->mobile,
            'name' => $request->name,
            'email' => $request->email,
            'tags' => $request->tags
        ]);

        DB::table('playsms_featurePhonebook_group_contacts')->where('pid',$id)->update(['gpid' => $request->gpid]);
        return redirect('/kontak/phonebook')->with('status', 'Kontak berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {
        Phonebook::destroy($phonebook->id);
        DB::table('playsms_featurePhonebook_group_contacts')->where('pid',$phonebook->id)->delete();
        return redirect('/kontak/phonebook')->with('status', 'Kontak berhasil dihapus');
    }

    protected function redirectTo($request)
    {
        return route('logins');
    }

    protected function deletes(Request $request)
    {
        // return route('logins');
        $Phonebooks_id_array = $request->input('id');

        $Phonebook = Phonebook::whereIn('id', $Phonebooks_id_array);
        $Phonebook_join_group = Phonebook_join_Groups::whereIn('pid', $Phonebooks_id_array)->delete();
        if($Phonebook->delete())
        {
            echo 'Data berhasil dihapus';
        }
    }

    protected function moves(Request $request)
    {


        $Phonebooks_id_array = $request->id;
        $gid = $request->gid;
        

        $PjG = DB::table('playsms_featurePhonebook_group_contacts')
            ->whereIn('pid', $Phonebooks_id_array);

        if($PjG->update(array('gpid' => $gid)))
        {
            echo 'Data berhasil dipindahkan';
        }
    
    }

    protected function movess(Request $request)
    {

        $Phonebooks_id_array = $request->id;
        $gid = $request->gid;
        

        $PjG = DB::table('playsms_featurePhonebook_group_contacts')
            ->whereIn('pid', $Phonebooks_id_array);

        if($PjG->update(array('gpid' => $gid)))
        {
            echo 'Data berhasil dipindahkan';
        }
    
    }

    public function import()
    {
        return view('admin.kontak.import.index');
    }

    public function parse_import(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $dataSetPhonebook = [];
        foreach ($data as $data){
            if(substr($data[1],0,1)=='0'){
                $mobile = '+62'. substr($data[1], 1);
            }else{
                if(substr($data[1],0,1)=='8'){
                    $mobile = '+62'. $data[1];
                }elseif(substr($data[1],0,2)=='62'){
                    $mobile = '+'. $data[1];
                }else{
                    $mobile = $data[1];
                }
            }

            if($data[0]!='Nama'){
                Phonebook::create([
                    'uid' => Auth::user()->uid,
                    'mobile' => $mobile,
                    'name' => $data[0],
                    'email' => $data[2],
                    'tags' => $data[3]
                ]);


                $dataSetPhonebook[] = ['name'    => $data[0]];
            }
        }
        //DB::table('playsms_featurePhonebook')->insert($dataSetPhonebook);
        $hasils = DB::table('playsms_featurePhonebook')->latest('created_at')->limit(count($dataSetPhonebook))->get();
        $idNewInsert = [];
        foreach ($hasils as $hasil){
                $idNewInsert[] = [
                    'gpid'    => '0',
                    'pid'    => $hasil->id
                ];
        }
        DB::table('playsms_featurePhonebook_group_contacts')->insert($idNewInsert);

        return redirect('/kontak/phonebook')->with('status', 'Import Berhasil');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PhonebooksExport, 'list.csv');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function ws_contact(request $request) 
    {
        // echo $request->app;
        if(substr($request->kwd,0,1) == '#'){
            $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Session::get('username').'&h='.Session::get('utoken').'&op=get_contact_group&kwd='.substr($request->kwd,1));
        }else{
            $data = file_get_contents('http://192.168.5.31/index.php?app=ws&u='.Session::get('username').'&h='.Session::get('utoken').'&op=get_contact&kwd='.$request->kwd);
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
                    "id"=>'#'.$jData['data'][$i]['code'],
                    "text"=>$jData['data'][$i]['group_name'] ."(". $jData['data'][$i]['code'].")"
                );
            }
        }
        // var_dump($jData);
        echo json_encode($data_arr, JSON_PRETTY_PRINT);
    }


    
}
