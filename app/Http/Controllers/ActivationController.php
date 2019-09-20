<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function aktifasi(Request $request){

        $hasil = User::where('username', $request->u)
          ->where('token', $request->t);

        if($hasil->update(['confirmcode' => 'y', 'status' => '3']))
        {
            return redirect(route('masuk'))->withInfo('Email Berasil diaktifasi, Silahkan login');
        }else{
            return redirect(route('masuk'))->withInfo('Aktifasi anda Gagal, silahkan registrasi ulang');
        }
    }
}
