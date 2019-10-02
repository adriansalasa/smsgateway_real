<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

class TemplateController extends Controller
{
    public function index(Request $request)
    {

            if(!isset($request->total)){$request->total = '10';}
            if(!isset($request->page)){$request->page = '1';}

            $Template = Template::where('uid', '=', Auth::user()->uid)
            ->whereRaw('(t_title like "%'.$request->keyword.'%" OR t_text like "%'.$request->keyword.'%" )')
                ->orderBY('tid', 'DESC')
                ->paginate($request->total); 
            // $Template->appends($request->only('keyword'));
            // $Template->appends($request->only('total'));

            return view('admin.template.index', compact('Template', 'request'));
    }

    public function add()
    {
        return view('admin.template.add');
    }

    public function edit($id)
    {
        $detail = Template::where('tid', $id)->first();
        return view('admin.template.edit', compact('detail','id'));
    }

    public function add_post(Request $request)
    {
    	$idnya = Auth::user()->uid;

        $simpan = new Template();
        $simpan->uid = $idnya;
        $simpan->t_title = $request->judul;
        $simpan->t_text = $request->pesan;
        $simpan->save();

        if(!isset($request->total)){$request->total = '10';}
        if(!isset($request->page)){$request->page = '1';}

        $Template = Template::where('uid', '=', Auth::user()->uid)
            ->orderBY('tid', 'DESC')
            ->paginate($request->total); 
        // $Template->appends($request->only('keyword'));
        // $Template->appends($request->only('total'));

        return redirect(route('admin.template'))->with('Template', 'request');
    }

    public function update(Request $request)
    {
        $update = Template::where('tid', $request->id)
            ->update([
               't_title' => $request->judul,
               't_text' => $request->pesan
            ]);

        if(!isset($request->total)){$request->total = '10';}
        if(!isset($request->page)){$request->page = '1';}

        $Template = Template::where('uid', '=', Auth::user()->uid)
            ->orderBY('tid', 'DESC')
            ->paginate($request->total); 
        // $Template->appends($request->only('keyword'));
        // $Template->appends($request->only('total'));

        return redirect(route('admin.template'))->with('Template', 'request');
    }

    public function destroy(Template $template)
    {
        Template::destroy($template->tid);
        return redirect(route('admin.template'))->with('status', 'Pesan berhasil dihapus');
    }

    public function deletes(Request $request){
        $Template_id_array = $request->input('id');

        $Template = Template::whereIn('tid', $Template_id_array);
        if($Template->delete())
        {
            echo 'Data berhasil dihapus';
        }
    }
}
