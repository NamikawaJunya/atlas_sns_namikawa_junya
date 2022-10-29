<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;//認証を使用する
use App\user;//user.phpを適応させる
use app\follow; //follow.phpを適応させる

class UsersController extends Controller
{
    //プロフィール
    public function profile()
    {
        return view('users.profile');
    }
    //ユーザーの全表示（名前だけでもOK）
    public function search()
    {
        $searchlist = \DB::table('users')->get();
        return view('users.search',['searchlist'=>$searchlist]);

    }
    //  ユーザー検索機能
    public function usersearch(Request $request)
    {
        $keyword_name = $request->usersearch;//名前を検索するための記述
        // $stock = $request->input('stock');ストックはいらないから消した

        // $query = Book::query();//クエリビルダは必須。Laravelとデータベースの紐付けをする。「問い合わせ（る）」、「訪ねる」などの意味を持つ英単語

        if (!empty($keyword_name)) {//変数が空かどうかを判定するには @empty ディレクティブを使用します。
            // $query=User::query();
            // $list = \DB::table('users')->get();
            $searchlist = User::where('username', 'like', "%{$keyword_name}%")->get();//likeは部分一致の意味を持つ。％はワイルドカード、PCの中では「どの文字列にも一致する」という意味を持っています。whereは「どこの」という意味を持つ。「WHERE」が意味するのは、「指定カラムのどんなレコードの値のものを取得するか」になります。矢印のように見える「->」は、アロー演算子（オブジェクト演算子）と呼ばれています。PHPのアロー演算子は、主にクラスから生成されたインスタンスで、プロパティやメソッドにアクセスする場合に用いられます。プロパティは、PHPにおけるクラスのメンバ変数のことです。オブジェクト指向プログラミングにおいては、オブジェクトの性質・状態などの情報を保持するために用いられます。人間で例えれば、名前・年齢・健康状態などがプロパティに保持すべき情報といえるでしょう。
                // ->orWhere('author', 'LIKE', "%{$keyword}%");参考サイトのストックの部分になるので不要と考えた
                return view('users.search')->with([//表示
                    'searchlist' => $searchlist,//リストの表示
                    'keyword_name' => $keyword_name,//キーワードの表示
                ]);
        }

        if(empty($keyword_name)) { //検索が空だったらリストを表示する
         $searchlist = \DB::table('users')->get();
         return view('users.search' , ['searchlist' => $searchlist]);

        }
        // if (!empty($stock)) {
        //     $query->where('stock', '>=', $stock);
        // }

        // $books = $query->get();

        // return view('book.index', compact('books', 'keyword', 'stock'));
    }

//フォロー系の記述

//フォロー
public function follow(User $user)
{
    $follower = Auth::user();
    //フォローしてるか
    $is_following = $follower->isfollowing($user->id);
    if(!$is_following) {
        //フォローしていなければフォローする
        $follower->follow($user->id);
        return back();
    }
}

//フォロー解除
public function unfollow(User $user)
{
    $follower = Auth::user();
    //フォローしているか
    $is_following = $follower->isfollowing($user->id);
    if($is_following) {
        //フォローしていればフォローを解除する
        $follower->unfollow($user->id);
        return back();
    }
}
}