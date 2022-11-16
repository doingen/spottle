@extends('layouts.layout')

@section('contents')
<title>変更内容確認</title>
<x-confirm>
  <x-slot name="title">変更内容</x-slot>
  <x-slot name="contents">
    <div class="confirm__inner--item">
      <span>使用機材</span>
      <p>{{$update["aircraft_name"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>スポット</span>
      <p>{{$update["spot_name"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>予約時間</span>
      <div class="confirm__inner--time">
        <p>開始：{{\App\Models\Reservation::dateReform($update["start_at"])}}(JST)</p><br>
        <p>終了：{{\App\Models\Reservation::dateReform($update["end_at"])}}(JST)</p>
      </div>
    </div>
  </x-slot>
  <x-slot name="button">
    <a class="confirm__button--back" onclick="history.back(); return false;">戻る</a>
    <form method="post" action="{{route('reserve.update', ['update' => $update])}}" class="confirm__button--reserve">
    @csrf
      <button>変更確定</button>
    </form>
  </x-slot>
</x-confirm>
@endsection