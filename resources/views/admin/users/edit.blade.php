<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin người dùng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Sửa thông tin người dùng</h1>
        @include('admin.header')

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu (để trống nếu không thay đổi)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="role">Vai trò</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="full_name">Họ và tên đầy đủ</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name }}">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <textarea class="form-control" id="address" name="address">{{ $user->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</body>
</html>
