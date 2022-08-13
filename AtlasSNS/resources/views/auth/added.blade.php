@extends('layouts.logout')

@section('content')

<div id="clear">
  <!--登録完了/登録者の名前の表示-->
  <p>{{ $name }}さん<img src="images/arrow.png"></p>
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection