<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function singleProduct(Product $product)
    {
        if (auth()->guest()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng.');
        }

        return view('cart.checkoutsingle', compact('product'));
    }

    public function processSingle(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Kiểm tra số lượng sản phẩm có sẵn trong kho
        if ($product->quantity < 1) {
            return redirect()->route('checkout.fail')->with('error', 'Số lượng sản phẩm bạn đặt mua lớn hơn số lượng có sẵn trong kho.');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $product->price,
            'payment_method' => $validated['payment_method'],
            'address' => $validated['address'],
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        $product->quantity -= 1;
        $product->save();

        return redirect()->route('checkout.success')->with('success', 'Bạn đã mua hàng thành công!');
    }
}
