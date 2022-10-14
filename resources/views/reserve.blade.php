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
    </div>
    <div class="reserve__second-search">
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
    </div>
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
    <div class="reserve__time-imput">
      <form method="post" action="{{route('reserve.create')}}">
        @csrf
        <div class="reserve__start-time">
          <select name="start_year">
            <option value="{{$calendar_row[0]->year}}">{{$calendar_row[0]->year}}</option>
            @if($calendar_row[0]->year != $calendar_row[$last_key]->year)
              <option value="{{$calendar_row[$last_key]->year}}" @if($calendar_row[$last_key]->year == old('start_year')) selected @endif>{{$calendar_row[$last_key]->year}}</option>
            @endif
          </select>
          <select name="start_date">
            @for($i=0; $i<=$open_days-1; $i++)
              <option value="{{$calendar_row[$i]->format('m-d')}}" @if($calendar_row[$i]->format('m-d') == old('start_date')) selected @endif>{{$calendar_row[$i]->format('m/d')}}</option>
            @endfor
          </select>
          <select name="start_hour">
            @for($i=0; $i<=$last_key; $i=$i+$open_days*4)
              <option value="{{$calendar_row[$i]->hour}}" @if($calendar_row[$i]->hour == old('start_hour')) selected @endif>{{$calendar_row[$i]->hour}}</option>
            @endfor
          </select>
          <select name="start_minutes">
            <option value="00" @if(00 == old('start_minutes')) selected @endif>00</option>
            <option value="15" @if(15 == old('start_minutes')) selected @endif>15</option>
            <option value="30" @if(30 == old('start_minutes')) selected @endif>30</option>
            <option value="45" @if(45 == old('start_minutes')) selected @endif>45</option>
          </select>
        </div>
        <div class="reserve__end-time">
          <select name="end_year">
            <option value="{{$calendar_row[0]->year}}">{{$calendar_row[0]->year}}</option>
            @if($calendar_row[0]->year != $calendar_row[$last_key]->year)
              <option value="{{$calendar_row[$last_key]->year}}" @if($calendar_row[$last_key]->year == old('end_year')) selected @endif>{{$calendar_row[$last_key]->year}}</option>
            @endif
          </select>
          <select name="end_date">
            @for($i=0; $i<=$open_days-1; $i++)
              <option value="{{$calendar_row[$i]->format('m-d')}}" @if($calendar_row[$i]->format('m-d') == old('end_date')) selected @endif>{{$calendar_row[$i]->format('m/d')}}</option>
            @endfor
          </select>
          <select name="end_hour">
            @for($i=0; $i<=$last_key; $i=$i+$open_days*4)
              <option value="{{$calendar_row[$i]->hour}}" @if($calendar_row[$i]->hour == old('end_hour')) selected @endif>{{$calendar_row[$i]->hour}}</option>
            @endfor
          </select>
          <select name="end_minutes">
            <option value="00" @if(00 == old('end_minutes')) selected @endif>00</option>
            <option value="15" @if(15 == old('end_minutes')) selected @endif>15</option>
            <option value="30" @if(30 == old('end_minutes')) selected @endif>30</option>
            <option value="45" @if(45 == old('end_minutes')) selected @endif>45</option>
          </select>
        </div>
        <input type="hidden" name="aircraft_id" value="{{$selected_a}}">
        <input type="hidden" name="spot_id" value="{{$selected_s}}">
        <button>予約する</button>
      </form>
    </div>
    @endisset
    {{session('error')}}
  </div>
</main>
@endsection