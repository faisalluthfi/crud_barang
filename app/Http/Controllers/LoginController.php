<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($credentials);
        if(auth()->attempt($credentials)){
            if(auth()->user()->type == 'admin'){
                return redirect()->route('dashboard');
            } else {
                return redirect('/');
            }
        } else  {
            return redirect()->route('login')->with('error','Email or Address are wrong');
        }
    }

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }

}
