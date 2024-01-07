<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::get();
        $title = 'Hapus User!';
        $text = "Apakah Anda Yakin ?";
        confirmDelete($title, $text);

        return view('user.index', ['user' => $user]);
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;


        $user = DB::table('users')
            ->where('first_name', 'like', "%" . $cari . "%")
            ->paginate();


        return view('user.index', ['user' => $user]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $validateData = Validator::make([]);

        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
            'type' => 'required',
            'password_confirmation'  => 'required'
        ]);
        $validateData['password'] = bcrypt('password');



        User::create($validateData);
        Alert::success('Berhasil', 'Data Berhasil Di Tambahkan');

        return redirect()->route('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        // dd($request);
        $user = User::find($id);
        $user->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            // "password" => $request->password,
            "type" => $request->type,
            // "password_confirmation" => $request->password_confirmation,
        ]);
        return redirect()->route('user')->with('success', 'Data Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::destroy($id);

        return redirect()->route('user')->with('success', 'Data Berhasil di Hapus');
    }
}
