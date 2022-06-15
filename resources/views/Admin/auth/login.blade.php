@extends('Layouts.admin.auth')

@section('content')
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                Login
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="input-text">Username</label>
                    <input type="text" name="uid" class="form-control" id="input-text" placeholder="Masukkan username">
                </div>

                <div class="form-group">
                    <label for="input-password">Password</label>
                    <input type="password" name="passwd" class="form-control" id="input-password" placeholder="Masukkan password">
                </div>
            </div>

            <div class="card-action">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>

        @error('uid')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
@endsection
