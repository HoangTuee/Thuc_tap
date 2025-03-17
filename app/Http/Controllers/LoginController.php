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
}
