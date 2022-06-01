<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //Route::get('/top', 'PostsController@index');の処理、ログイン指定
    public function index()
    {
        return view('posts.index');
    }
}