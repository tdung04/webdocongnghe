@extends('layouts.user')

@section('title', 'Your Shopping Cart')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>Giỏ hàng của bạn</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <p>Giỏ hàng của bạn hiện chưa có sản phẩm nào.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grand_total = 0;
                @endphp
                @foreach($cartItems as $item)
                    @php
                        $product_total = $item->product->price * $item->quantity;
                        $grand_total += $product_total;
                    @endphp
                    <tr data-id="{{ $item->id }}">
                        <td>
                            <img src="{{ asset('storage/' . $item->product->image) }}" width="50" height="50" alt="{{ $item->product->name }}">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->product->price, 0, ',', '.') }}₫</td>
                        <td>
                            <input type="number" class="quantity-input" name="quantity" value="{{ $item->quantity }}" min="1" data-id="{{ $item->id }}" style="width: 50px;">
                        </td>
                        <td class="product-total">{{ number_format($product_total, 0, ',', '.') }}₫</td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-remove">Xóa</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            <h4>Tổng thành tiền: <span id="grand-total">{{ number_format($grand_total, 0, ',', '.') }}₫</span></h4>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg">Thanh toán</a>
        </div>
    @endif
</div>
@endsection

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle quantity changes
            document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        let row = this.closest('tr');
        let id = this.dataset.id;
        let quantity = this.value;

        if (quantity < 1) {
            alert('Số lượng phải lớn hơn 0');
            this.value = 1;
            return;
        }

        fetch(`{{ url('cart/update') }}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity })
        }).then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                alert(data.message); // Hiển thị thông báo lỗi
            } else {
                row.querySelector('.product-total').innerText = data.product_total;
                document.getElementById('grand-total').innerText = data.grand_total;
            }
        });
    });
});


            // Handle item removal
            document.querySelectorAll('.btn-remove').forEach(button => {
                button.addEventListener('click', function() {
                    let row = this.closest('tr');
                    let id = row.dataset.id;

                    fetch(`{{ url('cart/remove') }}/${id}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    }).then(response => {
                        if (response.ok) {
                            row.remove();

                            // Recalculate grand total
                            let grandTotal = 0;
                            document.querySelectorAll('tbody tr').forEach(r => {
                                let rowTotal = parseFloat(r.querySelector('.product-total').innerText.replace(/[^0-9,-]+/g,"").replace(',', ''));
                                grandTotal += rowTotal;
                            });
                            document.getElementById('grand-total').innerText = grandTotal.toLocaleString('vi-VN') + '₫';

                            // Update cart count
                            let cartCount = parseInt(document.querySelector('.badge.badge-danger').innerText) - 1;
                            if (cartCount > 0) {
                                document.querySelector('.badge.badge-danger').innerText = cartCount;
                            } else {
                                document.querySelector('.badge.badge-danger').style.display = 'none';
                            }
                        } else {
                            alert('Could not remove item from cart.');
                        }
                    });
                });
            });
        });
    </script>
@endsection
