<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <!-- Bao gồm file header -->
        @include('admin.header')

        <h2>Sửa Đơn Hàng</h2>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang chờ xác nhận</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang vận chuyển</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao hàng</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>
