<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        return view('admin.products.create');
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'detail' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->move(
                base_path() . '/public/storage/product_images',
                $imageName
            );
            $imagePath = 'product_images/' . $imageName;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'detail' => $request->detail,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'detail' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'detail', 'price', 'quantity', 'category']);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Lưu ảnh mới
            $imageName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->move(
                base_path() . '/public/storage/product_images',
                $imageName
            );
            $imagePath = 'product_images/' . $imageName;
            $data['image'] = $imagePath;
        }
        // Cập nhật sản phẩm
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        // Xóa ảnh nếu có
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Xóa sản phẩm
        $product->delete();

        // Chuyển hướng với thông báo thành công
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    // Thống kê sản phẩm
    public function statistics(Request $request)
    {
        $month = $request->month; // Lấy tháng từ yêu cầu

        // Thống kê bán hàng và tồn kho
        $salesQuery = \DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', \DB::raw('SUM(order_items.quantity) as total_sold'), 'products.quantity as stock_remaining');

        if ($month) {
            $salesQuery->whereMonth('order_items.created_at', $month); // Lọc theo tháng nếu có
        }

        $salesData = $salesQuery->groupBy('products.id')->get();

        // Tính toán doanh thu hàng tháng và hàng năm
        $monthlyRevenue = \DB::table('orders')
            ->when($month, function ($query) use ($month) {
                return $query->whereMonth('created_at', $month);
            })
            ->sum('total');

        $yearlyRevenue = \DB::table('orders')
            ->whereYear('created_at', now()->year)
            ->sum('total');

        return view('admin.statistics', compact('salesData', 'monthlyRevenue', 'yearlyRevenue', 'month'));
    }
}
