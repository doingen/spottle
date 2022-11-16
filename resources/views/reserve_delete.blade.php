@extends('layouts.layout')

@section('contents')
<title>取り消し内容確認</title>
<x-confirm>
  <x-slot name="title">取り消し内容</x-slot>
  <x-slot name="contents">
    <div class="confirm__inner--item">
      <span>予約番号</span>
      <p>{{$r->id}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>スポット</span> 
      <p>{{$name["spot_name"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>使用機材</span>
      <p>{{$name["aircraft_name"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>予約時間</span>
      <div class="confirm__inner--time">
        <p>開始：{{\App\Models\Reservation::dateReform($r->start_at)}}(JST)</p><br>
        <p>終了：{{\App\Models\Reservation::dateReform($r->end_at)}}(JST)</p>
      </div>
    </div>
  </x-slot>
  <x-slot name="button">
    <a class="confirm__button--back" onclick="history.back(); return false;">戻る</a>
    <form method="post" action="{{route('reserve.delete', ['reservation' => $r->id])}}" class="confirm__button--reserve">
    @csrf
      <button>取り消す</button>
    </form>
  </x-slot>
</x-confirm>
@endsection