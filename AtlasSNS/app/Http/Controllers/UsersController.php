<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //プロフィール
    public function profile()
    {
        return view('users.profile');
    }
    //検索機能
    public function search()
    {
        return view('users.search');
    }
}