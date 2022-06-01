<?php

namespace App\Http\Controllers\Auth; //どこにファイルがあるかの処理

use App\User; //このクラス使うよの記述
use App\Http\Controllers\Controller; //このクラス使うよの記述
use Illuminate\Support\Facades\Validator; //このクラス使うよの記述
use Illuminate\Foundation\Auth\RegistersUsers; //このクラス使うよの記述
use Illuminate\Http\Request; //このクラス使うよの記述
//Illuminateは、laravelでプロジェクトを作成した時に自動生成される、vendorディレクトリ配下に存在する。vender > laravel > framework > src > Illuminate,要約すると、Laravelの大事なコンポーネントが置いてある場所ということです。


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //バリデーションルール
    // //protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'username' => 'required|string|max:255',
    //         'mail' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:4|confirmed',
    //     ]);
    //     $validator = Validator::make($request, $rule);
    //     if ($validator->fails()) {
    //         // バリデーションに引っかかった場合の処理
    //         'username' => '入力されていません。',
    //         'mali' => '入力されていません。',
    //         'password' => '入力されていません。',
    //     }:


    // if ($validator->fails()) {
    //return redirect('post/create')
    //->withErrors($validator)
    //->withInput();
    //}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    //クリエイト処理
    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'username' => $data['username'],
    //         'mail' => $data['mail'],
    //         'password' => bcrypt($data['password']),
    //     ]);
    // }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    //上2つ（バリデーションとクリエイトの処理の呼び出し）の記述

    public function register(Request $request) //左のrequestはuse宣言の〇〇/requestの省略、受け取ったデータをコントローラー内では＄requestという変数で使う為「requestデータは＄requestとして使う」と宣言
    {
        if ($request->isMethod('post')) {//指定したHTTP動詞と一致していればtrueをそうでなければfalseを返す。指定は大文字・小文字の区別なし。
            $data = $request->input(); //指定したキーの値を取得。デフォルト値を指定できる

            $this->create($data); //$thisはクラスの中で使い、ここで呼び出すメソッドをインスタンスメソッドという。インスタンスメソッドは、クラス内であればスコープ外（関数の外）であっても、そのメソッドを呼び出すことができる。class RegisterController extends Controllerで指定したpublic function create(array $data)を呼んでいる。
            {
            return redirect('added'); //
        }
        return view('auth.register');
    }

    //登録完了/登録者の名前の表示(新規登録後のようこそ画面)
    public function added()
    {
        return view('auth.added');
    }
}