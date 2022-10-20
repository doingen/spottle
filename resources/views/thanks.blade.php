@extends('layouts.layout')

@section('contents')
<main>
  <div class="thanks__wrapper">
    <div class="thanks__contents">
      <p>ご予約ありがとうございます</p><br>
      <a href="{{route('main.index')}}" class="thanks__contents--top">トップページ</a>
      <a href="" class="thanks__contents--mypage">マイページ</a>
    </div>
  </div>
</main>
@endsection