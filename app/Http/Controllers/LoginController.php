<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login_error' => 'Sai tài khoản hoặc mật khẩu']);
        }

        Auth::login($user);
        session(['phanquyen' => $user->phanquyen]);

        //phan quyen
        if ($user->phanquyen == 'admin') {
            return redirect()->route('admin');
        } elseif ($user->phanquyen == 'banhang') {
            return redirect()->route('sanpham');
        } else {
            return redirect('/'); // Mặc định về trang chủ
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('phanquyen');
        return redirect('/login');
    }

    public function signup(){
        return view('login.signup');
    }

    public function add_signup(Request $request){
        $request->validate([
            'username'  => 'required|max:100',
            'password'  => 'required|max:100',
            'phanquyen' => '',
        ]);
        $user = new User();
        $user->username         = $request->username;
        $user->password         = bcrypt($request->password); // Mật khẩu mã hóa
        $user->password_plaintext = $request->password;       // Mật khẩu plaintext
        $user->phanquyen        = $request->phanquyen ?: '0';
        $user->save();
        return redirect()->route('login')->with('success', 'Đăng nhập thành công!');
    }
}
