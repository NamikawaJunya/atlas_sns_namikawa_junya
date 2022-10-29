@extends('layouts.login')

@section('content')
<!-- ユーザー検索 -->
<!-- 検索フォームの設置 -->
<form action="/usersearch" method="post">
  @csrf
  <input type="text" placeholder="ユーザー名" name="usersearch">
  <input type="submit" value="検索">
  <!-- class="btn-success pull-right" -->
</form>

<!-- 空ではなく検索が入力されたら表示する -->
@if(!empty($keyword_name))
<!--usercontrollerのキーワード検索するための記述-->
<p>検索ワード:{{$keyword_name}}</p>
@endif


<div class="showsearch">
  <!--繰り返し処理-->
  @foreach ($searchlist as $searchlist)
  @if(Auth::id() != $searchlist->id)
  <ul>
    <!--ユーザーの表示-->
    <li>{{ $searchlist->username }}</li>
  </ul>
  @endif
  <div class="d-flex justify-content-end flex-frow-1">
    @if(Auth::user()->isfollowing($searchlist->id))
    <form action="/usersearch" method="post">
      <button type="submit" class="btn-primary">フォローする</button>
    </form>
    @else
    <div>
      <form action="/usersearch" method="post">
        @csrf
        {{ method_field('DELETE')}}
        <botton type="submit" class="btn-danger">フォロー解除</botton>
      </form>
      @endif
    </div>
    @endforeach
    @endsection