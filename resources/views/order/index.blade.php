@extends('layouts.user')

@section('title', 'Lịch sử đặt hàng')

@section('content')
<div class="container">
    <h1>Lịch sử đặt hàng</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Tổng cộng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
