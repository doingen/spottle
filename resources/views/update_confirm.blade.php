@extends('layouts.layout')

@section('contents')
<title>変更内容確認</title>
<x-confirm>
  <x-slot name="title">変更内容</x-slot>
  <x-slot name="attribute">
    <p>使用機材</p>
    <p>駐機スポット</p>
    <p>予約時間</p>
  </x-slot>
  <x-slot name="contents">
    <p>{{$update["aircraft_name"]}}</p>        
    <p>{{$update["spot_name"]}}</p>
    <p><font color="red">開始：{{\App\Models\Reservation::dateReform($update["start_at"])}}</font></p>
    <p><font color="red">終了：{{\App\Models\Reservation::dateReform($update["end_at"])}}</font></p>
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