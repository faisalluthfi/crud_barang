<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barang = Barang::get();
        
        $title = 'Hapus Barang!';
        $text = "Apakah Anda Yakin ?";
        confirmDelete($title, $text);
        return view('barang.index',['barang' => $barang]);
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.form');
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
            "kode_barang" => 'required|max:20',
            "nama_barang" => 'required|min:3|max:255|unique:barang',
            "kategori_barang" => 'required',
            "harga"=> 'required',
            "jumlah" => 'required'
        ]);

        Barang::create($validateData);
        Alert::success('Berhasil', 'Data Berhasil Di Tambahkan');


        return redirect()->route('barang');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $barang = Barang::find($id);

        return view('barang.edit',['barang'=>$barang]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, Barang $barang)
    {
        $barang = Barang::find($id);
        $barang->update([
            "kode_barang"=>$request->kode_barang,
            "nama_barang"=>$request->nama_barang,
            "kategori_barang"=>$request->kategori_barang,
            "harga"=>$request->harga,
            "jumlah"=>$request->jumlah,
        ]);

        return redirect()->route('barang')->with('success','Data Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      
        Barang::destroy($id);
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return redirect()->route('barang')->with('success','Data Berhasil di Hapus');
    }
}
