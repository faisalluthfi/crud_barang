@extends('layouts.app')

@section('title', 'Data User')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        </div>
        <form action="{{ route('user.cari') }}" method="get"
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2" name="cari" id="cari"
                    value="{{ old('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <a href="{{ route('user.create') }}" class="btn btn-primary mb-4">Tambah Barang</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($user as $row)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $row->first_name }}</th>
                                <th>{{ $row->last_name }}</th>
                                <th>{{ $row->email }}</th>
                                <th>{{ $row->type }}</th>
                                <th>{{ $row->created_at }}</th>
                                <th>
                                    <a href="{{ route('user.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                    {{-- <a href="{{ route('user.destroy',$row->id) }}" class="btn btn-danger" data>Hapus</a> --}}
                                    <form action="{{ route('user.destroy', $row->id) }}" method="post" class="d-inline"
                                        data-confirm-delete="true">
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
