<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 🟢 Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🟢 Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Nếu là admin → chuyển đến trang quản trị
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.index'); // Đảm bảo web.php có route này
            }

            // Nếu là user thường → về trang chủ
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }

    // 🟢 Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 🟢 Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }

    // 🟢 Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất.');
    }
}
