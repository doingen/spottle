@extends('layouts.layout')

@section('contents')
<title>予約する</title>
<main>
  <div class="reserve__first-search">
    <p>使用機材を選択し決定ボタンを押してください</p>
    <div class="reserve__first-search--box">
      <form method="get" action="{{route('reserve.first_search')}}">
        @csrf
        <span>使用機材</span>
        <select name="aircraft_id">
            <option value=""></option>
          @foreach($aircraft as $aircraft)
            <option value="{{$aircraft->id}}">{{$aircraft->name}}</option>
          @endforeach
        </select>
        <button>決定</button>
      </form>
      <form method="get" action="">
        @csrf
        <span>駐機スポット</span>
      </form>
    </div>
  </div>
</main>
@endsection