<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <!-- Bao gồm file header -->
        @include('admin.header')

        <h2>Chi Tiết Đơn Hàng #{{ $order->id }}</h2>

        <p><strong>Khách hàng:</strong> {{ $order->user->name }}</p>
        <p><strong>Tổng:</strong> {{ number_format($order->total, 2) }} VND</p>
        <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>

        <h3>Chi tiết sản phẩm:</h3>
        <ul>
            @foreach ($order->items as $item)
                <li>{{ $item->product->name }} - Số lượng: {{ $item->quantity }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>
