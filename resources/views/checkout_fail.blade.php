<!-- resources/views/cart/checkout_success.blade.php -->

@extends('layouts.user')

@section('title', 'Thanh Toán Thất Bại')

@section('content')
<div class="container text-center">
    <h1>Sản phẩm bạn muốn mua hiện tại đang không có đủ trong kho của chúng tôi!</h1>
    <p>Chúng tôi sẽ nhập hàng nhanh nhất có thể.</p>
    <p>Xin lỗi bạn vì sự bất tiện này.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Quay lại trang chủ</a>
</div>
@endsection
