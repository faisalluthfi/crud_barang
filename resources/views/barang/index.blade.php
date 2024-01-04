@extends('layouts.app')

@section('title','Data Barang')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-4">Tambah Barang</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ( $barang as $row)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $row->kode_barang }}</th>
                        <th>{{ $row->nama_barang }}</th>
                        <th>{{ $row->kategori_barang }}</th>
                        <th>{{ $row->harga }}</th>
                        <th>{{ $row->jumlah }}</th>
                        <th>
                            <a href="{{ route('barang.edit',$row->id) }}" class="btn btn-warning">Edit</a>
                            {{-- <a href="{{ route('barang.destroy',$row->id) }}" class="btn btn-danger" data>Hapus</a> --}}
                            <form action="{{ route('barang.destroy',$row->id) }}" method="post" class="d-inline" data-confirm-delete="true">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" data-confirm-delete="true">
                                    Hapus
                                </button>
                            </form>
                                
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection