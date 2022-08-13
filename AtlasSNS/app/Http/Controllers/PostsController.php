<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //Route::get('/top', 'PostsController@index');の処理、ログイン指定
    public function index()
    {
        return view('posts.index');

    }
//投稿フォームの記述
//ルーティング第二引数から呼び出せるようにメソッドを追加する
    public function post(Request $request)
    {
        $id = Auth::id();
        $post = $request->input('newPost')
        \DB::table('posts')->insert([//
            'post' => $post,
            'user_id' => $id
        ])
        return view('posts.createForm');
    }
}