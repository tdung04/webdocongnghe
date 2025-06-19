<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Useradmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = Useradmin::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
            'full_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Useradmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function edit(Useradmin $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, Useradmin $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
            'full_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Chuẩn bị dữ liệu cập nhật
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Kiểm tra và cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // Cập nhật thông tin người dùng
        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Thông tin người dùng đã được cập nhật.');
    }

    public function destroy(Useradmin $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa.');
    }
}
