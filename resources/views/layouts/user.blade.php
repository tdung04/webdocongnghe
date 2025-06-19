<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- General Styles CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- Page-specific styles -->
    @yield('styles')
</head>
<body>
    <div class="content-wrapper">
        <!-- Header -->
        <header>
            <div class="logo">
                <img src="{{ asset('images/Logo_white.png') }}" alt="Logo" />
                <span>ALICE COMPUTER SHOP</span>
            </div>
            <nav class="navigation-menu">
                <ul>
                    <li><a href="{{ route('products.index') }}">Trang chủ</a></li>
                    <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <!-- <li><a href="{{ route('services.index') }}">Dịch vụ</a></li> -->
                    <li><a href="{{ route('promotion.index') }}">Khuyến mãi</a></li>
                    <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                    <li><a href="{{ route('support.index') }}">Hỗ trợ</a></li>
                </ul>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer style="margin-top:20px">
        <div class="footer-container">
            <div class="footer-section contact-info">
                <h4>Thông tin liên hệ</h4>
                <p>Địa chỉ: Số 123, Đường ABC, Thành phố XYZ</p>
                <p>Điện thoại: 0123 456 789</p>
                <p>Email: alicecomputershop2003@gmail.com</p>
            </div>
            <div class="footer-section quick-links">
                <h4>Liên kết nhanh</h4>
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/products">Sản phẩm</a></li>
                    <!-- <li><a href="/services">Dịch vụ</a></li> -->
                    <li><a href="/contact">Liên hệ</a></li>
                    <li><a href="/support">Hỗ trợ</a></li>
                    <li><a href="/privacy-policy">Chính sách bảo mật</a></li>
                    <li><a href="/terms">Điều khoản sử dụng</a></li>
                </ul>
            </div>
            <div class="footer-section social-media">
                <h4>Theo dõi chúng tôi</h4>
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('images/facebook-icon.png') }}" alt="Facebook" /></a>
                    <a href="#"><img src="{{ asset('images/zalo-icon.png') }}" alt="Zalo" /></a>
                </div>
            </div>
            <div class="footer-section newsletter">
                <h4>Đăng ký nhận tin</h4>
                <form id="subscribe-form" action="{{ route('subscribe') }}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="Nhập email của bạn" required />
                    <button type="submit">Đăng ký</button>
                    <div class="loading-icon" id="loading-icon"></div>
                </form>
                <!-- Hiển thị thông báo -->
                <div id="subscription-message" class="mt-2"></div>
            </div>
            <div class="footer-section payment-methods">
                <h4>Phương thức thanh toán</h4>
                <div class="payment-icons">
                    <img src="{{ asset('images/visa-icon.png') }}" alt="Visa" />
                    <img src="{{ asset('images/cash-icon.png') }}" alt="Tiền Mặt" />
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Công ty TNHH ABC. Bảo lưu mọi quyền.</p>
        </div>
    </footer>
    @yield('scripts')  <!-- Load javascript -->
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.getElementById('subscribe-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn việc gửi form truyền thống

            const form = event.target;
            const formData = new FormData(form);
            const loadingIcon = document.getElementById('loading-icon');
            const messageContainer = document.getElementById('subscription-message');

            // Hiển thị icon loading và xóa thông báo cũ
            loadingIcon.style.display = 'inline-block';
            messageContainer.innerHTML = '';

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Ẩn icon loading
                loadingIcon.style.display = 'none';

                if (data.success) {
                    messageContainer.innerHTML = `<div class="alert alert-success">${data.success}</div>`;
                } else if (data.error) {
                    messageContainer.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Ẩn icon loading nếu có lỗi xảy ra
                loadingIcon.style.display = 'none';
                messageContainer.innerHTML = `<div class="alert alert-danger">Đã xảy ra lỗi. Vui lòng thử lại.</div>`;
            });
        });
    </script>
</body>
</html>
