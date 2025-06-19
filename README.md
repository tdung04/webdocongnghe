**Cách cài đặt**

- Tải và cài đặt Visual Studio Code (VSCode)

- Tải và cài đặt MySQL

- Tải và cài dặt XAMPP

- Tải và cài đặt Lavarel, lưu lavarel vào trong thư mục cài đặt XAMPP theo đường dẫn "xampp/htdocs"

- Tải và cài đặt composer

- Tải folder chứa code về từ trong drive

- Giải nén sau đó sử dụng VSCode mở thư mục vừa giải nén 

- Sau khi mở folder bằng VSCode, tìm file "database.sql"
	+ Mở MySQL và chạy câu lệnh sau để khởi tạo 1 cơ sở dữ liệu: CREATE DATABASE webcuoiki
	+ Chọn cơ sở dữ liệu "webcuoiki" vừa tạo làm schema mặc định
	+ Copy nội dung file "database.sql" vào MySQL sau đó chạy để khởi tạo dữ liệu

- Quay lại VSCode và tìm file ".env"
	+ Tìm tới dòng "DB_PASSWORD="
	+ Thay phần mật khẩu thành mật khẩu MySQL của bạn

- Tại cửa sổ terminal trong VSCode chạy lệnh: php artisan serve

- Chờ một chút sau đó nhấn Ctrl + Click vào phần link được hiện ra

- Done 

**Tài khoản Admin**
- Tài khoản: admin@gmail.com
- Mật khẩu: admin
