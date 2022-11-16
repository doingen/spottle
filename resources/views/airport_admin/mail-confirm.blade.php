@extends('layouts.airport_admin')

@section('contents')
<title>送信内容確認</title>
<div class="aa__wrapper">
  <div class="aa_mail__outer">
    <h2 class="aa__page-title">送信内容確認</h2>
    <a class="aa_mail__outer--back" onclick="history.back(); return false;"><i class="fa-solid fa-angles-left"></i>戻る</a>
    <div class="aa_mail__inner">
      <form method="post" action="{{route('airport_admin.mail')}}">
        @csrf
        <div class="aa_mail__item aa_mail__item--to">
          <span>TO</span>
          <p>利用者全員</p>
        </div>
        <div class="aa_mail__item aa_mail__item--subject">
          <span>件名</span>
          <p>{{$mail["subject"]}}</p>
        </div>
        <div class="aa_mail__item aa_mail__item--contents">
          <p class="aa_mail__item--confirm">{{$mail["text"]}}</p>
        </div>        
        <input type="hidden" name="subject" value="{{$mail["subject"]}}"">
        <input type="hidden" name="text" value="{{$mail["text"]}}"">
        <button><i class="fa-solid fa-paper-plane"></i>送信</button>
      </form>
    </div>
  </div>
</div>
@endsection