@extends('layouts.layout')

@section('contents')
<div class="thanks__wrapper">
  <div class="thanks__contents">
    @if(Request::routeIs('reserve.create'))
      <p>ご予約ありがとうございます</p><br>
      <a href="{{route('main.index')}}" class="thanks__contents--top">トップへ</a>
      <a href="{{route('user.index')}}" class="thanks__contents--mypage">マイページ</a>
    @elseif(Request::routeIs('register.create'))
      <p>ご登録ありがとうございます。</p>
      <p>ご登録いただいたメールアドレスへ認証メールを送信しましたので、
      確認をお願いいたします。</p><br>
      <a href="{{route('main.index')}}" class="thanks__contents--top">トップへ</a>
    @elseif(Request::routeIs('logout'))
      <p>ログアウトしました。<br>
      ご利用ありがとうございます。</p><br>
      <a href="{{route('main.index')}}" class="thanks__contents--top">トップへ</a>
    @elseif(Request::routeIs('reserve.update'))
      <p>予約変更が完了しました</p><br>
      <a href="{{route('main.index')}}" class="thanks__contents--top">トップへ</a>
      <a href="{{route('user.index')}}" class="thanks__contents--mypage">マイページ</a>
    @elseif(Request::routeIs('review.create'))
      <p>レビューを投稿しました</p><br>
      <a href="{{route('main.index')}}" class="thanks__contents--top">トップへ</a>
      <a href="{{route('user.index')}}" class="thanks__contents--mypage">マイページ</a>
    @endif
  </div>
</div>
@endsection