@extends('layouts.layout')

@section('contents')
<title>予約する</title>
<main>
  <div class="reserve__first-search">
    <p>&#9312;使用機材を選択し決定ボタンを押してください</p>
    <div class="reserve__first-search--box">
      <form method="get" action="{{route('reserve.first_search')}}">
        @csrf
        <select name="aircraft_id">
          @foreach($aircraft as $aircraft)
            <option value="{{$aircraft->id}}" @if($selected == $aircraft->id) selected @endif>{{$aircraft->name}}</option>
          @endforeach
        </select>
        <button>決定</button>
      </form>
      <form method="get" action="">
        @csrf
        <p>&#9313;駐機スポットを選択し検索ボタンを押してください</p>
        <select name="spot_id">
          @isset($spots)
            @foreach($spots as $spots)
              @foreach($spots->spots as $spot)
                <option value="{{$spot->id}}">{{$spot->name}}</option>
              @endforeach
            @endforeach
          @endisset
        </select>
        <button>検索</button>
      </form>
    </div>
  </div>
</main>
@endsection