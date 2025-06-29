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
            'username' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login_error' => 'Sai email đăng nhập hoặc mật khẩu']);
        }

        Auth::login($user);
        session(['phanquyen' => $user->phanquyen]);

        //phan quyen
        if ($user->phanquyen == 'admin') {
            return redirect()->route('admin');
        } elseif ($user->phanquyen == 'sale') {
            return redirect()->route('sale');
        } else {
            return redirect('/'); // Mặc định về trang chủ
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('phanquyen');
        return redirect('/');
    }

    public function signup(){
        return view('login.signup');
    }

    public function add_signup(Request $request){
        $request->validate([
            'username'  => 'required|email|max:100',
            'password'  => 'required|max:100',
            'phanquyen' => '',
        ]);
        if (User::where('username', $request->username)->exists()) {
            return redirect()->back()->with('username_error', 'Email đăng nhập đã tồn tại!');
        }
        $user = new User();
        $user->username         = $request->username;
        $user->password         = bcrypt($request->password); // Mật khẩu mã hóa
        $user->password_plaintext = $request->password;       // Mật khẩu plaintext
        $user->phanquyen        = $request->phanquyen ?: '0';
        $user->save();
        return redirect()->route('login')->with('success', 'Đăng ký thành công, hãy đăng nhập!');
    }
}
