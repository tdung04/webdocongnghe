<!-- resources/views/products/show.blade.php -->

@extends('layouts.user')

@section('title', 'Product Details')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="container mt-5">
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
                        @if(session('cart_count') && session('cart_count') > 0)
                        <span class="badge badge-pill badge-danger">{{ session('cart_count') }}</span>
                        @endif
                        Giỏ hàng
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
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            @endif
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->category }}</p>
            <p class="lead">{{ number_format($product->price, 0, ',', '.') }}₫</p>
            <p>{!! nl2br(e($product->description)) !!}</p>
            
            <!-- Add to cart form -->
            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="add-to-cart-form mb-3">
                @csrf
                <button type="submit" class="btn btn-success btn-lg">Thêm vào giỏ</button>
            </form>
            <!-- <a href="{{ route('checkout.single', $product->id) }}" class="btn btn-primary btn-sm buy-button">Mua hàng</a> -->
            
        </div>
    </div>

    <hr class="my-4 product-details-divider">
    <div>
        <h2 class="detail_h2">Chi tiết sản phẩm</h2>
        <div class="indented-paragraph">
            @foreach (explode("\n", $product->detail) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Additional JavaScript if needed
    });
</script>
@endsection
