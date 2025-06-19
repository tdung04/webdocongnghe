<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        $existingCartItem = CartItem::where('user_id', $user->id)->where('product_id', $product->id)->first();

        $newQuantity = ($existingCartItem ? $existingCartItem->quantity + 1 : 1);

        if ($newQuantity > $product->quantity) {
            return redirect()->back()->with('error', 'Không đủ hàng để thêm vào giỏ. Chỉ còn lại ' . $product->quantity . ' sản phẩm.');
        }

        $cartItem = CartItem::firstOrNew([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        // Cập nhật số lượng giỏ hàng trong session để hiển thị trên biểu tượng giỏ hàng
        session()->put('cart_count', CartItem::where('user_id', $user->id)->sum('quantity'));

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem sản phẩm trong giỏ hàng.');
        }

        $cartItems = Auth::user()->cartItems()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function remove($id)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $cartItem->delete();

        // Cập nhật lại số lượng giỏ hàng trong session
        session()->put('cart_count', CartItem::where('user_id', $user->id)->sum('quantity'));

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        $product = $cartItem->product;

        if ($request->quantity > $product->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Số lượng sản phẩm không đủ, chỉ còn lại ' . $product->quantity . ' sản phẩm.'
            ]);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Tính tổng số tiền mới cho sản phẩm
        $product_total = number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') . '₫';

        // Tính tổng số tiền của giỏ hàng
        $grand_total = CartItem::where('user_id', $user->id)->with('product')->get()
            ->sum(fn($item) => $item->product->price * $item->quantity);
        $grand_total = number_format($grand_total, 0, ',', '.') . '₫';

        return response()->json([
            'product_total' => $product_total,
            'grand_total' => $grand_total,
            'status' => 'success'
        ]);
    }


    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        return view('cart.checkout', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();

        // Lưu hoặc cập nhật địa chỉ và số điện thoại của người dùng
        $user->update([
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'address' => $validated['address'],
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            $item->product->quantity -= $item->quantity;
            $item->product->save();
        }

        $user->cartItems()->delete();

        session()->forget('cart_count');

        return redirect()->route('checkout.success')->with('success', 'Bạn đã mua hàng thành công!');
    }

}
