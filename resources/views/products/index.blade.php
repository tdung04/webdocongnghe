@extends('layouts.user')

@section('title', 'Danh Sách Sản Phẩm')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
@endsection

@section('content')
<div class="product-page container" style="padding-top: 20px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#"><h1>ALICE COMPUTER SHOP</h1></a>
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

    <!-- Promotional Banner -->
    <body>
        <div class="scroll" style="--t:20s">
            <div>
                <span>Chào mừng bạn đến với Alice Computer Shop</span>
                <span>Chúc bạn có những giây phút mua sắm thoải mái</span>
            </div>
            <div>
                <span>Chào mừng bạn đến với Alice Computer Shop</span>
                <span>Chúc bạn có những giây phút mua sắm thoải mái</span>
            </div>
        </div>
        <div class="scroll imgbx" style="--t:100s">
            <div id="scroll-container">
                <img src="{{ asset('images/banner1.jpg') }}" />
                <img src="{{ asset('images/banner2.jpg') }}" />
                <img src="{{ asset('images/banner3.jpg') }}" />
                <img src="{{ asset('images/banner4.jpg') }}" />
                <img src="{{ asset('images/banner5.jpg') }}" />
                <img src="{{ asset('images/banner6.jpg') }}" />
            </div>
            <div>
                <img src="{{ asset('images/banner1.jpg') }}" />
                <img src="{{ asset('images/banner2.jpg') }}" />
                <img src="{{ asset('images/banner3.jpg') }}" />
                <img src="{{ asset('images/banner4.jpg') }}" />
                <img src="{{ asset('images/banner5.jpg') }}" />
                <img src="{{ asset('images/banner6.jpg') }}" />
            </div>
        </div>
    </body>

    <h1>Danh Sách Sản Phẩm</h1>

    <!-- Search and Filter Form -->
    <form class="filter-form" method="GET" action="{{ route('products.index') }}">
    <div class="form-row">
        <div class="col-md-3 mb-3">
            <input type="text" name="search" class="form-control" placeholder="Tên sản phẩm" value="{{ request('search') }}">
        </div>
        <div class="col-md-3 mb-3">
            <select name="price_range" class="form-control">
                <option value="">Chọn khoảng giá</option>
                <option value="5-20" {{ request('price_range') == '5-20' ? 'selected' : '' }}>5.000.000đ - 20.000.000đ</option>
                <option value="20-35" {{ request('price_range') == '20-35' ? 'selected' : '' }}>20.000.000đ - 35.000.000đ</option>
                <option value="35-50" {{ request('price_range') == '35-50' ? 'selected' : '' }}>35.000.000đ - 50.000.000đ</option>
                <option value="50+" {{ request('price_range') == '50+' ? 'selected' : '' }}>50.000.000đ+</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <select name="category" class="form-control">
                <option value="all">Tất cả</option>
                <option value="PC" {{ request('category') == 'PC' ? 'selected' : '' }}>PC</option>
                <option value="Laptop" {{ request('category') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                <option value="linhkien" {{ request('category') == 'linhkien' ? 'selected' : '' }}>Linh Kiện</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
        </div>
    </div>
</form>


    <!-- Product Listing -->
    <div class="product-container">
    @foreach($products as $product)
<div class="product-card">
    @if($product->quantity > 0)
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @endif
    @else
        <img src="{{ asset('images/sold-out.webp') }}" alt="Hết hàng" class="sold-out-image">
    @endif
        <h5 class="product-name">
            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
        </h5>
        <p class="product-description">{!! nl2br(e($product->description)) !!}</p>
        <p class="product-price">Price: {{ number_format($product->price, 0, ',', '.') }}₫</p>
        <div class="product-actions">
             @if($product->quantity > 0)
                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="add-to-cart-form" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Thêm vào giỏ</button>
                </form>
            @endif
        </div>
    @auth
        <div class="favorite-icon">
            <i class="bi bi-heart"></i>
        </div>
    @endauth
</div>
@endforeach

    </div>

    <!-- Pagination Links -->
    <div class="pagination-container">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/banner.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle favorite icon color
        const favoriteIcons = document.querySelectorAll('.favorite-icon .bi-heart, .favorite-icon .bi-heart-fill');
        favoriteIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                if (this.classList.contains('bi-heart')) {
                    this.classList.remove('bi-heart');
                    this.classList.add('bi-heart-fill');
                } else {
                    this.classList.remove('bi-heart-fill');
                    this.classList.add('bi-heart');
                }
                // Optionally, you can add AJAX request here to update the favorite status on the server
            });
        });
        
        // Toggle description expand
        const readMoreLinks = document.querySelectorAll('.product-page .read-more');
        readMoreLinks.forEach(link => {
            link.addEventListener('click', function() {
                const description = this.previousElementSibling;
                if (description && description.classList.contains('product-description')) {
                    description.classList.toggle('expanded');
                    this.textContent = description.classList.contains('expanded') ? 'Thu gọn' : 'Xem thêm';
                } else {
                    console.error('Corresponding product description not found');
                }
            });
        });

        // Check if user is logged in before performing actions
        document.querySelectorAll('.buy-button, .add-to-cart-form, .add-to-favorites-form').forEach(element => {
            element.addEventListener('click', function(event) {
                @guest
                event.preventDefault(); // Prevent the default action
                alert('Bạn cần đăng nhập để thực hiện hành động này!');
                window.location.href = "{{ route('login') }}";
                @endguest
            });
        });
    });
</script>
@endsection
