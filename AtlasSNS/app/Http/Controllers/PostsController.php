<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PostsController extends Controller
{
    //Route::get('/top', 'PostsController@index');の処理、ログイン指定と投稿の表示
    public function index()
    {
        $list = \DB::table('posts')->get();
        return view('posts.index',['list'=>$list]);

    }
//投稿フォームの記述
// ルーティング第二引数から呼び出せるようにメソッドを追加する
    public function post(Request $request)
    {
        // ログインできていれば勝手に投稿されるが自動的にログアウトされていると表示されない
        $id = Auth::id();
        // ここに投稿内容を飛ばす
        $post = $request->input('content');
        \DB::table('posts')->insert([
            // ここのカラムに格納する
            'post' => $post,
            'user_id' => $id
        ]);
        return redirect('/top');
    }
    // 投稿内容更新の記述
    public function update(Request $request)
    {
    $id = $request->input('id');
        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );

        return redirect('/top');
    }
// 投稿内容削除の記述
    public function delete(Request $request)
    {
    $id = $request->input('id');
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }
}