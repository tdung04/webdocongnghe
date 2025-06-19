@extends('layouts.auth')

@section('title', 'Đăng Nhập')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <h2>Đăng Nhập</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="alert alert-error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="button">Đăng Nhập</button>
    </form>
    <p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
@endsection
