@extends('layouts.login')

@section('content')
<!-- メインコンテンツ表示のページ -->
<div>
  <form action="/post" method="post">
    @csrf
    <div>
      <!-- 投稿内容入れる ⬇︎-->
      <input name="content" placeholder="投稿内容を入力してください"></input>
      <button><img src="images/post.png"></button>
    </div>
  </form>
</div>

<div>
  <!-- 30〜40はモーダルの一部でこのforeachの中に投稿の編集ボタンや削除ボタンを追加してあげる
      foreach文またはfor-each文（フォーイーチぶん）とは、プログラミング言語においてリストや連想配列などの「コレクション」と呼ばれるデータ構造の各要素に対して与えられた文の実行を繰り返すループ文である。foreach文はしばしばfor文の一部という位置付けにあるが、for文と異なり要素の参照順序が定義されないことがある。 -->
  @foreach ($list as $list)
  <ul>
    <li>{{ $list->id }}</li>
    <li>{{ $list->post }}</li>
    <div class="content">
      <!-- 編集ボタンにpost属性とpost_id属性を追加し、それぞれの投稿内容と投稿idのデータを持たせます。
例えば、「こんにちは」と投稿された投稿に設置されている編集ボタンではpost=”こんにちは”となるわけです。 -->
      <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
        <!-- 投稿の編集ボタン -->
        <p>編集<img src="edit.png"></p>
      </a>
      <!-- 投稿内容削除のモーダル -->
      <a href="/post/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
        <!-- 削除の編集ボタン -->
        <p>削除<img src="trash-h.png"></p>
      </a>
    </div>
    <li>{{ $list->created_at }}</li>
  </ul>
  @endforeach
  <!-- モーダルの中身を書く -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/update" method="post">
        @csrf
        <textarea name="upPost" class="modal_post"></textarea>
        <input type="hidden" name="id" class="modal_id" value="{{ $list->id }}">
        <!-- {{--!! Form::hidden('id', $post->id) !!--}}は41行目と同じ意味を持つ -->
        <input type="submit" value="更新">
      </form>
      <a class="js-modal-close" href="">閉じる</a>
    </div>
  </div>
  @endsection