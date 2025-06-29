<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function qlphanloai()
    {
        return view('admin.ql_phanloai');
    }

    // xu li them sua xoa user
    //hien thi  form them user
    public function view_add_user()
    {
        return view('admin.form.Add_user');
    }
    //xu li them user
    public function add_user(Request $request)
    {
        $request->validate([
            'username'  => 'required|email|max:100',
            'password'  => 'required|max:100',
            'phanquyen' => '',
        ]);
        $user = new User();
        $user->username         = $request->username;
        $user->password         = bcrypt($request->password); // Mật khẩu mã hóa
        $user->password_plaintext = $request->password;       // Mật khẩu plaintext
        $user->phanquyen        = $request->phanquyen ?: '0';
        $user->save();
        return redirect()->route('qladmin')->with('success', 'User đã được tạo thành công!');
    }
    //hien thi form sua user
    public function view_edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.form.Edit_user', compact('user'));
    }
    //xu li sua user
    public function edit_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username'  => 'required|email|max:100',
            'password'  => 'required|max:100',
            'phanquyen' => '',
        ]);

        $user->username         = $request->username;
        $user->password         = bcrypt($request->password); // Mật khẩu mã hóa
        $user->password_plaintext = $request->password;       // Mật khẩu plaintext
        $user->phanquyen        = $request->phanquyen ?: '0';
        $user->save();
        return redirect()->route('qladmin')->with('success', 'User đã được update thành công!');
    }
    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('qladmin')->with('success', 'User đã được xóa thành công!');
    }

    public function qladmin()
    {
        $users = User::all(); // Lấy danh sách user từ database
        return view('admin.ql_admin', compact('users'));
    }

    public function timKiem(Request $request)
{
    $keyword = $request->input('keyword');

    $users = User::where('username', 'LIKE', "%{$keyword}%")
        ->orWhere('phanquyen', 'LIKE', "%{$keyword}%")
        ->paginate(10);

    return view('admin/ql_admin', compact('users'));
}

}
