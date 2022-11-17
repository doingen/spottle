@extends('layouts.layout')

@section('contents')
<title>送信完了</title>
<div class="thanks__wrapper">
  <div class="thanks__contents">
    <p>メール送信完了しました</p><br>
    <a href="{{route('airport_admin.index')}}" class="thanks__contents--top">メニュー</a>
    <a href="{{route('airport_admin.mail')}}" class="thanks__contents--mypage">メール作成</a>
  </div>
</div>
@endsection