@extends('layouts.user')

@section('title', 'Checkout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>Thanh toán</h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="address">Địa chỉ nhận hàng:</label>
            <input type="text" id="address" name="address" class="form-control" 
                   value="{{ old('address', Auth::user()->address) }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" class="form-control" 
                   value="{{ old('phone', Auth::user()->phone) }}" required>
        </div>

        <h3>Sản phẩm trong giỏ hàng</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 0, ',', '.') }}₫</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h4>Tổng thành tiền: 
                <strong>
                    {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}₫
                </strong>
            </h4>
        </div>

        <h3>Phương thức thanh toán:</h3>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="paymentVisa" value="visa" required>
            <label class="form-check-label" for="paymentVisa">Visa</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="paymentMomo" value="momo" required>
            <label class="form-check-label" for="paymentMomo">Momo</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="paymentATM" value="atm" required>
            <label class="form-check-label" for="paymentATM">ATM</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="paymentCOD" value="cod" required>
            <label class="form-check-label" for="paymentCOD">Thanh toán khi nhận hàng (COD)</label>
        </div>

        <!-- Divs cho từng phương thức thanh toán -->
        <div id="visa-info" class="payment-info" style="display: block;">
            <h3>Thông tin thẻ VISA</h3>
            <div class="form-group">
                <label for="visaCardNumber">Số thẻ Visa:</label>
                <input type="text" id="visaCardNumber" name="visa_card_number" class="form-control">
            </div>
            <div class="form-group">
                <label for="visaExpiryDate">Ngày hết hạn:</label>
                <input type="text" id="visaExpiryDate" name="visa_expiry_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="visaCVC">CVC:</label>
                <input type="text" id="visaCVC" name="visa_cvc" class="form-control">
            </div>
        </div>

        <div id="momo-info" class="payment-info" style="display: none;">
            <h3>Thông tin số MOMO</h3>
            <div class="form-group">
                <label for="momoAccount">Số tài khoản Momo:</label>
                <input type="text" id="momoAccount" name="momo_account" class="form-control">
            </div>
        </div>

        <div id="atm-info" class="payment-info" style="display: none;">
            <h3>Thông tin thẻ ATM</h3>
            <div class="form-group">
                <label for="atmBank">Ngân hàng:</label>
                <input type="text" id="atmBank" name="atm_bank" class="form-control">
            </div>
            <div class="form-group">
                <label for="atmName">Tên chủ thẻ:</label>
                <input type="text" id="atmName" name="atm_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="atmCardNumber">Số thẻ:</label>
                <input type="text" id="atmCardNumber" name="atm_card_number" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Thanh toán</button>
    </form>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Chọn Visa mặc định khi tải lại trang
    document.getElementById("paymentVisa").checked = true;

    // sự kiện khi radio button thay đổi
    let paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    paymentMethods.forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Ẩn tất cả các div thông tin thanh toán
            document.querySelectorAll('.payment-info').forEach(function(div) {
                div.style.display = 'none';
            });

            // Hiển thị div tương ứng với phương thức thanh toán được chọn
            let selectedPaymentMethod = this.value;
            document.getElementById(selectedPaymentMethod + '-info').style.display = 'block';
        });
    });
});
</script>

<style>
    #visa-info {
        display: block; 
    }

    #momo-info,
    #atm-info {
        display: none; 
    }
    .payment-info {
        margin-top: 20px; 
    }

</style>