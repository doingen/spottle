@extends('layouts.layout')

@section('contents')
<title>予約内容確認</title>
<main>
  <div class="confirm__wrapper">
    <h2>予約内容確認</h2>
    <div class="confirm__contents">
      <span class="confirm__list">使用機材</span>
      <p>{{$reservation["aircraft_name"]}}</p>
      <span class="confirm__list">駐機スポット</span>
      <p>{{$reservation["spot_name"]}}</p>
      <span class="confirm__list">予約時間</span>
      <p>開始：{{$reservation["start_at"]}}</p>
      <p>終了：{{$reservation["end_at"]}}</p>
      <a onclick="history.back(); return false;">戻る</a>
      <a href="{{route('reserve.create', ['reservation' => $reservation])}}">予約確定</a>
    </div>
  </div>
</main>
@endsection