@extends('layouts.user')

@section('title', 'Liên hệ')

@section('content')
<div class="contact-info-container">
    <h1><b>Thông tin liên hệ</b></h1>
    <p>Địa chỉ: Số 123, Đường ABC, Thành phố XYZ</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: alicecomputershop2003@gmail.com</p>
</div>
<div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4430.686325675351!2d105.74582524865524!3d20.96262282470558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313452efff394ce3%3A0x391a39d4325be464!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBQaGVuaWthYQ!5e0!3m2!1svi!2s!4v1719713878196!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endsection

@section('styles')
<style>
    .contact-info-container {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .contact-info-container h1 {
        margin-bottom: 20px;
        font-size: 24px;
    }

    .contact-info-container p {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .map-container {
        flex: 1;
    }

    .map-container iframe {
        width: 100%;
        height: 500px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
