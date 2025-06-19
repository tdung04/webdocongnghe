<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.product')->latest()->get();
        return view('user.orders', compact('orders'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user information
        $user->full_name = $request->input('full_name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.!');
    }
}
