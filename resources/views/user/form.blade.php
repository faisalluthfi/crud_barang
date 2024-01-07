@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-10 font-weight-bold primary">Form Data User</h6>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                id="first_name" name="first_name" value="{{ isset($user) ? $user->first_name : '' }}">
                            @error('first_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name" value="{{ isset($user) ? $user->last_name : '' }}">
                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ isset($user) ? $user->email : '' }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="type"> </label>
                            <input type="number" class="form-control @error('type') is-invalid @enderror" id="type"
                                name="type" value="{{ isset($user) ? $user->type : '' }}">
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">User Type</label>
                            <select class="form-control @error('type') is-invalid @enderror"
                                aria-label="Default select example" name="type" id="exampleFormControlSelect1">
                                <option selected value="0">User</option>
                                <option value="1">Admin</option>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror "
                                id="password" name="password">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8 or more characters long, contain letters and numbers, and must not
                                contain spaces.
                            </div>
                            <input type="checkbox" onclick="Toggle()">
                            <small>Show Password</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Confirmation</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation">
                            @error('password')
                                <div clas="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div id="passwordHelpBlock" class="form-text">
                                Must be same with password field
                            </div>
                            <input type="checkbox" onclick="ToggleConfirm()">
                            <small>Show Password</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
