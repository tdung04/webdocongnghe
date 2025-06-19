<!-- resources/views/cart/checkout_success.blade.php -->

@extends('layouts.user')

@section('title', 'Thanh Toán Thành Công')

@section('content')
<div class="container text-center">
    <h1>Cảm ơn bạn đã mua hàng!</h1>
    <p>Đơn hàng của bạn đã được xử lý thành công.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Quay lại trang chủ</a>
</div>
@endsection
