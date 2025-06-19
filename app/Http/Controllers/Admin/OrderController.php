<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get()->map(function ($order) {
            $order->status_vn = $this->translateStatus($order->status);
            return $order;
        });
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Thêm trạng thái tiếng Việt vào đơn hàng
        $order->status_vn = $this->translateStatus($order->status);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        // Hiển thị form chỉnh sửa đơn hàng
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,paid',
        ]);


        $order->update($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa.');
    }

    private function translateStatus($status)
    {
        $translations = [
            'pending' => 'Đang chờ xác nhận',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đã vận chuyển',
            'delivered' => 'Đã giao hàng',
            'paid' => 'Đã thanh toán',
        ];

        return $translations[$status] ?? $status;
    }
}
