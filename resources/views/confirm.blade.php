@extends('layouts.layout')

@section('contents')
@php
  $start_at = substr($reservation["start_at"], 0,16);
  $end_at = substr($reservation["end_at"], 0,16);
@endphp
<title>予約内容確認</title>
<main>
  <div class="confirm__wrapper">
    <h2>予約内容</h2>
    <div class="confirm__contents">
      <div class="confirm__contents--left">
        <p>使用機材</p>
        <p>駐機スポット</p>
        <p>予約時間</p>
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
        <button>予約確定</button>
      </form>
    </div>
  </div>
</main>
@endsection