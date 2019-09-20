<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
         return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInfo('Email dan password tidak boleh kosong.');
        }

        $user = User::whereRaw('(email = "' .$request->email.'" OR username = "' .$request->email. '" OR mobile = "' .$request->email.'")')
                  ->where('password',md5($request->password))
                  ->first();
        if($user == null){
            return redirect(route('masuk'))->withInfo('Email atau Password Salah');

        }else{
            Auth::login($user);
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('masuk'));
    }
}
