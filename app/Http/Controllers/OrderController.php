<?php

// OrderController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy các đơn hàng liên quan đến người dùng đã xác thực
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();

        // Lấy tất cả sản phẩm
        $products = Product::all();

        // Truyền cả đơn hàng và sản phẩm đến view
        return view('user.orders', compact('orders', 'products'));
    }
}
