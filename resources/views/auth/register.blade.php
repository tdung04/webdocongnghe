@extends('layouts.auth')

@section('title', 'Đăng Ký')

@section('content')
    <h2>Đăng Ký</h2>
    
    <!-- Hiển thị thông báo lỗi nếu có -->
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Hiển thị thông báo thành công nếu có -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="alert alert-error">{{ $message }}</div>
            @enderror
        </div>
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
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            @error('password_confirmation')
                <div class="alert alert-error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="button">Đăng Ký</button>
    </form>
    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập tại đây</a></p>
@endsection
