@extends('layouts.layout')

@section('contents')
<title>マイページ</title>
<div class="mypage__wrapper">
  <div class="mypage__outer">
    <h2>マイページ</h2>
    <section class="mypage__reserve">
      <h3>予約一覧</h3>
      <div class="mypage__reserve--inner">
        @foreach($user as $user)
          $user->
        @endforeach
      </div>
    </section>
    <section class="mypage__review">
      <h3>口コミを書く</h3>
    </section>
  </div>
</div>
@endsection