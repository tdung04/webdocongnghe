@extends('layouts.user')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container">
    <h1>Thông tin cá nhân</h1>

    <!-- Navigation for User Profile -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">ALICE COMPUTER SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Shopping Cart -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart"></i>
                        <span class="badge badge-pill badge-danger">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span> Giỏ hàng
                    </a>
                </li>
                <!-- User Greeting, Dropdown Menu, and Logout -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xin chào, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">Thông tin cá nhân</a>
                            <a class="dropdown-item" href="{{ route('user.orders') }}">Lịch sử đặt hàng</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">Đăng xuất</button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Display Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Profile Information Card -->
    <div class="card">
        <div class="card-body">
            <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Email (non-editable) -->
                <div class="form-group">
                    <label for="email">Địa chỉ email:</label>
                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                </div>

                <!-- Full Name (editable) -->
                <div class="form-group">
                    <label for="full_name">Họ tên:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" readonly>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-primary edit-btn" data-target="#full_name">Thay đổi</button>
                        </div>
                    </div>
                </div>

                <!-- Phone Number (editable) -->
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" readonly>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-primary edit-btn" data-target="#phone">Thay đổi</button>
                        </div>
                    </div>
                </div>

                <!-- Address (editable) -->
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <div class="input-group">
                        <textarea class="form-control" id="address" name="address" readonly>{{ old('address', $user->address) }}</textarea>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-primary edit-btn" data-target="#address">Thay đổi</button>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-primary" id="saveButton" style="display: none;">Lưu thay đổi</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = document.querySelector(this.dataset.target);
                    if (target) {
                        target.removeAttribute('readonly');
                        target.focus();
                        this.style.display = 'none';
                        document.getElementById('saveButton').style.display = 'inline-block';
                    }
                });
            });
        });
    </script>
@endsection
