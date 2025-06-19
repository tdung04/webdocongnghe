<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Gửi email xác nhận
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alicecomputershop2003@gmail.com';
            $mail->Password = 'ttdqvvmwmmeymaxr';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('alicecomputershop2003@gmail.com', 'Alice Computer Shop');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; // Thiết lập mã hóa UTF-8 cho nội dung email
            $mail->Encoding = 'base64'; // Thiết lập mã hóa base64 cho nội dung email
            $mail->SubjectEncoding = 'UTF-8';
            $mail->Subject = 'Đăng ký nhận tin thành công';
            $mail->Body    = 'Cảm ơn bạn đã đăng ký nhận tin từ Alice Computer Shop.';

            $mail->send();

            return response()->json(['success' => 'Đăng ký nhận tin thành công! Vui lòng kiểm tra email của bạn.']);
        } catch (Exception $e) {
            return response()->json(['error' => "Có lỗi xảy ra. Mailer Error: {$mail->ErrorInfo}"]);
        }
    }
}
