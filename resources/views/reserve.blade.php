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
            <option value="{{$aircraft->id}}" @if($selected_a == $aircraft->id) selected @endif>{{$aircraft->name}}</option>
          @endforeach
        </select>
        <button>決定</button>
      </form>
      <form method="get" action="{{route('reserve.second_search', ['aircraft_id' => $selected_a])}}">
        @csrf
        <p>&#9313;駐機スポットを選択し検索ボタンを押してください</p>
        <select name="spot_id">
          @isset($spots)
            @foreach($spots as $spots)
              @foreach($spots->spots as $spot)
                <option value="{{$spot->id}}" @if($selected_s == $spot->id) selected @endif>{{$spot->name}}</option>
              @endforeach
            @endforeach
          @endisset
        </select>
        <button>検索</button>
      </form>
      @isset($calender_array)
      <div class="reserve__calender">
        <table>
          <tr>
            <th></th>
            @for($i=0; $i<$open_days; $i++)
              <th>{{$calender_array[$i]->format("m/d")}}</th>
            @endfor
          </tr>
          @for($i=0; $i<=$last_key; $i=$i+$open_days)
            <tr>
              <td>{{$calender_array[$i]->format("H:i")}}</td>
              @for($j=$i; $j<$i+$open_days; $j++)
                @if(in_array($calender_array[$j], $arr)) 
                  <td>✕</td>
                @else
                  <td>◎</td>
                @endif
              @endfor
            </tr>
          @endfor
        </table>
      </div>
      @endisset
    </div>
  </div>
</main>
@endsection