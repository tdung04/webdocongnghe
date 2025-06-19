<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <!-- Bao gồm file header -->
        @include('admin.header')

        <h2>Danh sách đơn hàng</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="orders-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Tổng</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ number_format($order->total, 2) }} VND</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ ucfirst($order->status_vn) }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-view">Xem</a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-edit">Sửa</a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
