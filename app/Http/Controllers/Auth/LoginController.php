<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Xác thực thông tin đăng nhập
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Chuyển hướng dựa trên vai trò của người dùng
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('products');
            }
        }

        // Thông tin đăng nhập không chính xác
        return back()->withErrors([
        ])->withInput()->with('error', 'Đăng nhập thất bại! Vui lòng kiểm tra lại thông tin.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Chuyển hướng về trang đăng nhập sau khi đăng xuất
        return redirect()->route('products.index');
    }
}
