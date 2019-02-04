<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class CrmController extends Controller
{
    public function login()
    {
        /*$user = new User;
        $user->name = 'admin';
        $user->email = 'admin@crm.com';
        $user->user_type = 1;
        $user->password = Hash::make('72g3rkua.3#j@pak');
        $user->save();*/
        if (Auth::check()) {
            return redirect()->route('index');
        } else {
            return view('crmlogin');
        }
    }

    public function loginToCrm(Request $request)
    {
        if (!empty($request->remember)) {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::attempt(['email' => $request->mail, 'password' => $request->password], $remember)) {
            return redirect()->route('index');
        } else {
            return redirect()->route('login')->with('status', 'error');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
