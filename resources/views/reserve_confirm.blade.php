@extends('layouts.layout')

@section('contents')
<title>予約内容確認</title>
<x-confirm>
  <x-slot name="title">予約内容</x-slot>
  <x-slot name="contents">
    <div class="confirm__inner--item">
      <span>使用機材</span>
      <p>{{$reservation["aircraft_name"]}}</p> 
    </div>
    <div class="confirm__inner--item">
      <span>スポット</span>
      <p>{{$reservation["spot_name"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>予約時間</span>
      <div class="confirm__inner--time">
        <p>開始：{{\App\Models\Reservation::dateReform($reservation["start_at"])}}(JST)</p><br>
        <p>終了：{{\App\Models\Reservation::dateReform($reservation["end_at"])}}(JST)</p>
      </div>
    </div>    
  </x-slot>
  <x-slot name="button">
    <a class="confirm__button--back" onclick="history.back(); return false;">戻る</a>
    <form method="post" action="{{route('reserve.create', ['reservation' => $reservation])}}" class="confirm__button--reserve">
    @csrf
      <button>予約確定</button>
    </form>
  </x-slot>
</x-confirm>
@endsection