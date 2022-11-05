@extends('layouts.layout')

@section('contents')
<title>予約内容確認</title>
<x-confirm>
  <x-slot name="title">予約内容</x-slot>
  <x-slot name="attribute">
    <p>使用機材</p>
    <p>駐機スポット</p>
    <p>予約時間</p>
  </x-slot>
  <x-slot name="contents">
    <p>{{$reservation["aircraft_name"]}}</p>        
    <p>{{$reservation["spot_name"]}}</p>
    <p>開始：{{\App\Models\Reservation::dateReform($reservation["start_at"])}}</p>
    <p>終了：{{\App\Models\Reservation::dateReform($reservation["end_at"])}}</p>
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