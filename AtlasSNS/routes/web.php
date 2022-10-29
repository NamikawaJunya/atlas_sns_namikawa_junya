<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ

//ツイートの表示
Route::get('/top', 'PostsController@index');
//投稿フォーム（URLで投稿内容を見られないためにPostを使う、単純に送り先がポストコントローラだから）
// Route::get('/createForm', 'PostsController@createForm');
// 新規投稿用の記述
Route::post('/post', 'PostsController@post');
// 投稿編集のURL
Route::post('/post/update', 'PostsController@update');
// 投稿削除のURL
Route::get('/post/{id}/delete', 'PostsController@delete');

//プロフィールURL
Route::get('/profile', 'UsersController@profile');

// ユーザー一覧のURL
Route::get('/search', 'UsersController@search');
//ユーザー検索のURL
Route::post('/usersearch', 'UsersController@usersearch');
//ユーザーページのフォロー
Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
//ユーザーページのフォロー解除
Route::delete('users/{user}unfollow', 'UsersController@unfollow')->name('unfollow');


//ログアウト
Route::get('/logout', 'Auth\LoginController@logout');

//ヘッダー/ロゴにトップへ遷移するリンクを設置
// Route::get('images/logo.png', 'Auth\LoginController@login');

//アコーディオンメニュー/トップ,プロフィールのリンク設置
//Route::get('/profile', '');

//サイドバー/フォロー,フォロワーリストへのリンクの設置
Route::get('/follow-list', 'followsController@followList');
Route::get('/follower-list', 'followsController@followerList');