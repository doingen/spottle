@extends('layouts.layout')

@section('contents')
@php
  $s = substr($reservation["start_at"], 0, 16);
  $e = substr($reservation["end_at"], 0, 16);
  $start_at = str_replace('-', "/", $s);
  $end_at = str_replace('-', "/", $e);
@endphp
<title>登録内容確認</title>
<div class="confirm__wrapper">
  <h2>予約内容</h2>
  <div class="confirm__contents">
    <div class="confirm__contents--left">
      <p>お名前</p>
      <p>メールアドレス</p>
      <p>電話番号</p>
      <p>パスワード</p>
    </div>
    <div class="confirm__contents--right">
      <p>{{$reservation["aircraft_name"]}}</p>        
      <p>{{$reservation["spot_name"]}}</p>
      <p>開始：{{$start_at}}</p>
      <p>終了：{{$end_at}}</p>
    </div>
  </div>
  <div class="confirm__button">
    <a class="confirm__button--back" onclick="history.back(); return false;">戻る</a>
    <form method="post" action="{{route('reserve.create', ['reservation' => $reservation])}}" class="confirm__button--reserve">
    @csrf
      <button>登録</button>
    </form>
  </div>
</div>
@endsection