@extends('layouts.user')

@section('title', 'Khuyến mãi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/promotion.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
@endsection

@section('content')
<!-- <div class="container mt-4">
    <h1>Khuyến mãi khách hàng mới</h1>
    <p>Ưu đãi khách hàng mới. Giảm lên tới 10% tổng hóa đơn</p>
    <h2>Danh sách các khuyến mãi:</h2>
    <ul>
        <li>Khuyễn mãi A: Mô tả chi tiết về khuyến mãi A.</li>
        <li>Khuyễn mãi B: Mô tả chi tiết về khuyến mãi B.</li>
        <li>Khuyễn mãi C: Mô tả chi tiết về khuyến mãi C.</li>
    </ul>
</div> -->
<div class="promotion-page container" style="padding-top: 20px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#"><h1>ALICE COMPUTER SHOP</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart"></i>
                        @if(session('cart_count') && session('cart_count') > 0)
                        <span class="badge badge-pill badge-danger">{{ session('cart_count') }}</span>
                        @endif
                        Giỏ hàng
                    </a>
                </li>
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

    <div class="promotion-header">
        <h1>Khuyến Mãi Đặc Biệt</h1>
        <p>Chào mừng bạn đến với trang khuyến mãi của Alice Computer Shop. Dưới đây là những khuyến mãi đặc biệt dành riêng cho bạn!</p>
    </div>

    <div class="promotion-banners">
        <div class="banner">
            <img src="{{ asset('images/promotion1.jpg') }}" alt="Promotion 1">
            <div class="banner-details">
                <h2>Giảm giá 20% cho tất cả các dòng PC Gaming</h2>
                <p>Áp dụng từ ngày 01/07 đến 31/07</p>
            </div>
        </div>
        <div class="banner">
            <img src="{{ asset('images/promotion2.jpg') }}" alt="Promotion 2">
            <div class="banner-details">
                <h2>Mua PC nhận ngay quà tặng trị giá 2 triệu đồng</h2>
                <p>Áp dụng từ ngày 01/07 đến 15/07</p>
            </div>
        </div>
        <div class="banner">
            <img src="{{ asset('images/promotion3.jpg') }}" alt="Promotion 3">
            <div class="banner-details">
                <h2>Giảm giá 10% khi mua phụ kiện kèm PC</h2>
                <p>Áp dụng từ ngày 10/07 đến 31/07</p>
            </div>
        </div>
    </div>

    <div class="promotion-list">
        <h2>Đợt Khuyến Mãi Hiện Tại</h2>
        <ul>
            <li>
                <h3>Giảm giá 20% cho tất cả các dòng PC Gaming</h3>
                <p>Áp dụng từ ngày 01/07 đến 31/07</p>
            </li>
            <li>
                <h3>Mua PC nhận ngay quà tặng trị giá 2 triệu đồng</h3>
                <p>Áp dụng từ ngày 01/07 đến 15/07</p>
            </li>
            <li>
                <h3>Giảm giá 10% khi mua phụ kiện kèm PC</h3>
                <p>Áp dụng từ ngày 10/07 đến 31/07</p>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection