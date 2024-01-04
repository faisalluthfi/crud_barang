<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
// use Illuminate\Validation\Validator;

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view ('register.index');

    }

    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'required' => 'The :attribute field is required.',
            // 'first_name'    => 'The :attribute must be a valid email address.',
            // 'last_name'    => 'The :attribute must be a valid email address.',
            'email'    => 'The :attribute must be a valid email address.',
            
            
            
        ];
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password'=> 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required'
        ],$messages);
        // $validator['password'] = Hash::make('password');


        
        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $user = User::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password)  
        ]);

        
        return redirect('register')->withSuccess('Berhasil Registrasi, Silahkan Login');
        
        // return redirect()->route('register');

        
    }
}
