<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
    	$idnya = Auth::user()->uid;
        $data = User::where('uid', $idnya)->first();
        return view('admin.profile.index',compact('data'));

    }

    public function edit()
    {
    	$idnya = Auth::user()->uid;
        $detail = User::where('uid', $idnya)->first();
        return view('admin.profile.edit', compact('detail'));
    }
    public function password()
    {
        return view('admin.profile.password');
    }

    public function update_profile(Request $request)
    {
        $idnya = Auth::user()->uid;

    	$validator = Validator::make($request->all(), [
            'mobile' => 'required|max:16'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInfo('Nomor telepon tidak boleh lebih dari 16 angka.');
        }

        $xusername = User::whereRaw('(username = "' .$request->username. '" AND uid != "' .$idnya.'")')->first();
        if (!empty($xusername)) {
            return redirect()->back()->withInfo('Username telah terdaftar, silahkan gunakan username lainnya.');
        }

        $xemail = User::whereRaw('(email = "' .$request->email. '" AND uid != "' .$idnya.'")')->first();
        if (!empty($xemail)) {
            return redirect()->back()->withInfo('Email telah terdaftar, silahkan gunakan email lainnya.');
        }

        $xmobile = User::whereRaw('(mobile = "' .$request->mobile. '" AND uid != "' .$idnya.'")')->first();
        if (!empty($xmobile)) {
            return redirect()->back()->withInfo('Nomor Telepon telah terdaftar, silahkan gunakan nomor telepon lainnya.');
        }


        if (empty($request->footer)) {
            $update = User::where('uid', $idnya)
            ->update([
               'footer' => ''
            ]);
        }else{
            $update = User::where('uid', $idnya)
            ->update([
               'footer' => $request->footer
            ]);
        }

        if (empty($request->city)) {
            $update = User::where('uid', $idnya)
            ->update([
               'city' => ''
            ]);
        }else{
            $update = User::where('uid', $idnya)
            ->update([
               'city' => $request->city
            ]);
        }

        if (empty($request->state)) {
            $update = User::where('uid', $idnya)
            ->update([
               'state' => ''
            ]);
        }else{
            $update = User::where('uid', $idnya)
            ->update([
               'state' => $request->state
            ]);
        }

        $update = User::where('uid', $idnya)
            ->update([
               'name' => $request->name,
               'username' => $request->username,
               'email' => $request->email,
               'mobile' => $request->mobile,
               'address' => $request->address
            ]);

        $data = User::where('uid', $idnya)->first();
        return view('admin.profile.index',compact('data'));
    }

    public function update_password(Request $request)
    {
    	$idnya = Auth::user()->uid;
    	$oldnya = Auth::user()->password;
        $data = User::where('uid', $idnya)->first();

    	$old = md5($request->old);
    	$new = md5($request->new);
    	$again = md5($request->again);

    	if ($oldnya!=$old) {
    		return redirect()->back()->withInfo('Password lama yang Anda masukan salah.');
    	}elseif($new!=$again){
    		return redirect()->back()->withInfo('Password baru dan konfirmasi password baru yang Anda masukan tidak sesuai.');
    	}

        $update = User::where('uid', $idnya)
            ->update([
               'password' => $new
            ]);

        // return view('admin.profile.index',compact('data'));
        Auth::logout();
        return redirect(route('masuk'))->withInfo('Ubah password berhasil. Silahkan login kembali.');
    }
}
