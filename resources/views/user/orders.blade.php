@extends('layouts.user')

@section('title', 'Lịch sử đặt hàng')

@section('content')
<div class="container">
    <h1>Lịch sử đặt hàng</h1>
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
    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    Đơn hàng #{{ $order->id }} - Ngày đặt: {{ $order->created_at->format('d-m-Y') }}
                </div>
                <div class="card-body">
                    <p>Trạng thái: {{ ucfirst($order->status) }}</p>
                    <p>Phương thức thanh toán: {{ ucfirst($order->payment_method) }}</p>
                    <p>Địa chỉ giao hàng: {{ $order->address }}</p>
                    <h5>Sản phẩm:</h5>
                    <ul>
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }} - Số lượng: {{ $item->quantity }} - Giá: {{ number_format($item->price, 0, ',', '.') }}₫</li>
                        @endforeach
                    </ul>
                    <h4 class="text-right">Tổng: {{ number_format($order->total, 0, ',', '.') }}₫</h4>
                </div>
            </div>
        @endforeach
    @endif
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