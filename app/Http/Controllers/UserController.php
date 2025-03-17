<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banner;

class UserController extends Controller
{
    public function laptop_new(){
        return view('user.laptop_new');
    }
    public function tintuc(){
        return view('user.tintuc');
    }
    public function laptopnew(){
        return view('user.laptop_new');
    }
    public function khuyenmai(){
        return view('user.khuyen_mai');
    }
    public function giohang(){
        return view('user.giohang');
    }

}
