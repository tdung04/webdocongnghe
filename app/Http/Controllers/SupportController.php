<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SupportController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

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
            $mail->setFrom($request->email, $request->name);
            $mail->addAddress('alicecomputershop2003@gmail.com');
            $mail->addReplyTo($request->email, $request->name);

            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; // Thiết lập mã hóa UTF-8 cho nội dung email
            $mail->Encoding = 'base64'; // Thiết lập mã hóa base64 cho nội dung email
            $mail->SubjectEncoding = 'UTF-8';
            $mail->Subject = $request->subject;
            $mail->Body = $request->message;

            // Send email to admin
            $mail->send();

            // Send thank you email to user
            $mail->clearAddresses();
            $mail->addAddress($request->email);
            $mail->Subject = 'Thank you for your feedback!';
            $mail->Body = 'Thank you for reaching out to us. We have received your message and will get back to you shortly.';

            $mail->send();

            return redirect()->back()->with('success', 'Message was sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
