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
      @isset($calendar_row)
      <div class="reserve__calendar">
        <table>
          <tr>
            <th></th>
            @for($i=0; $i<$open_days; $i++)
              <th>{{$calendar_row[$i]->format("m/d")}}</th>
            @endfor
          </tr>
          @for($i=0; $i<=$last_key; $i=$i+$open_days)
            <tr>
              <td>{{$calendar_row[$i]->format("H:i")}}</td>
              @for($j=$i; $j<$i+$open_days; $j++)
                @if(in_array($calendar_row[$j], $reserved_date)) 
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
      <div class="reserve__time-imput">
        <form method="post" action="">
          @csrf
          <div class="reserve__start-time">
            <select name="year">
              <option value="{{$calendar_row[0]->year}}">{{$calendar_row[0]->year}}</option>
              @if($calendar_row[0]->year != $calendar_row[$last_key]->year)
                <option value="{{$calendar_row[$last_key]->year}}">{{$calendar_row[$last_key]->year}}</option>
              @endif
            </select>
            <select name="month">
              <option value="{{$calendar_row[0]->month}}">{{$calendar_row[0]->month}}</option>
              @if($calendar_row[0]->month != $calendar_row[$last_key]->month)
                <option value="{{$calendar_row[$last_key]->month}}">{{$calendar_row[$last_key]->month}}</option>
              @endif
            </select>
            <select name="day">
              @for($i=0; $i<=$open_days-1; $i++)
                <option value="{{$calendar_row[$i]->day}}">{{$calendar_row[$i]->day}}</option>
              @endfor
            </select>
            <select name="hour">
              @for($i=0; $i<=$last_key; $i=$i+$open_days*4)
                <option value="{{$calendar_row[$i]->hour}}">{{$calendar_row[$i]->hour}}</option>
              @endfor
            </select>
            <select name="minutes">
              <option value="00">00</option>
              <option value="15">15</option>
              <option value="30">30</option>
              <option value="45">45</option>
            </select>
          </div>
          <div class="reserve__end-time">
            <select name="year">
              <option value="{{$calendar_row[0]->year}}">{{$calendar_row[0]->year}}</option>
              @if($calendar_row[0]->year != $calendar_row[$last_key]->year)
                <option value="{{$calendar_row[$last_key]->year}}">{{$calendar_row[$last_key]->year}}</option>
              @endif
            </select>
            <select name="month">
              <option value="{{$calendar_row[0]->month}}">{{$calendar_row[0]->month}}</option>
              @if($calendar_row[0]->month != $calendar_row[$last_key]->month)
                <option value="{{$calendar_row[$last_key]->month}}">{{$calendar_row[$last_key]->month}}</option>
              @endif
            </select>
            <select name="day">
              @for($i=0; $i<=$open_days-1; $i++)
                <option value="{{$calendar_row[$i]->day}}">{{$calendar_row[$i]->day}}</option>
              @endfor
            </select>
            <select name="hour">
              @for($i=0; $i<=$last_key; $i=$i+$open_days*4)
                <option value="{{$calendar_row[$i]->hour}}">{{$calendar_row[$i]->hour}}</option>
              @endfor
            </select>
            <select name="minutes">
              <option value="00">00</option>
              <option value="15">15</option>
              <option value="30">30</option>
              <option value="45">45</option>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection