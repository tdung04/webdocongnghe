<div class="header">
    <h1>Xin chào, {{ Auth::user()->name }}</h1>
    <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-nav">Trang chủ Admin</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-nav">Quản lý Người dùng</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-nav">Quản lý đơn hàng</a>
        <a href="{{ route('admin.statistics') }}" class="btn-nav">Thống kê sản phẩm</a>
    </nav>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-logout">Đăng xuất</button>
    </form>
</div>

<!-- Thêm CSS thẳng cho phần header -->
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        color: #333333;
    }

    .admin-nav {
        display: flex;
        gap: 15px; /* Khoảng cách giữa các nút */
    }

    .btn-nav {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-nav:hover {
        background-color: #0056b3;
        transform: translateY(-2px); /* Hiệu ứng nâng nút khi di chuột */
    }

    .btn-logout {
        padding: 10px 20px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-logout:hover {
        background-color: #c82333;
        transform: translateY(-2px); /* Hiệu ứng nâng nút khi di chuột */
    }
</style>
