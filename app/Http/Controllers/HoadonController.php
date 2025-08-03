<?php

namespace App\Http\Controllers;

use App\Models\Donhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoadonController extends Controller
{
    public function hienthihoadon(){
        $orders = Donhang::where('id_user', Auth::id())->latest()->paginate(10);
        return view('user.hoadon', compact('orders'));
    }
}
