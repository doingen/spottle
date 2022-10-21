@extends('layouts.layout')

@section('contents')
<script src="https://kit.fontawesome.com/99288424cc.js" crossorigin="anonymous"></script>
<title>予約する</title>
<main>
  <div class="reserve__wrapper">
    <div class="reserve__block">
      <div class="reserve__first-search">
        <span class="reserve__step">Step 1</span>
        <h2 class="reserve__search--title">使用機材</h2>
        <div class="reserve__search--box">
          <form method="get" action="{{route('reserve.first_search')}}">
            @csrf
            <select name="aircraft_id" class="reserve__input">
              @foreach($aircraft as $aircraft)
                <option value="{{$aircraft->id}}" @if($selected_a == $aircraft->id) selected @endif>{{$aircraft->name}}</option>
              @endforeach
            </select>
            <button>決定</button>
          </form>
        </div>
      </div>
      @isset($selected_s)
      <div class="reserve__second-search">
        <span class="reserve__step">Step 2</span>
        <h2 class="reserve__search--title">駐機スポット</h2>
        <div class="reserve__search--box">
          <form method="get" action="{{route('reserve.second_search', ['aircraft_id' => $selected_a])}}">
            @csrf
            <select name="spot_id" class="reserve__input">
              @isset($spots)
                @foreach($spots as $spots)
                  @foreach($spots->spots as $spot)
                    <option value="{{$spot->id}}" @if($selected_s == $spot->id) selected @endif>{{$spot->name}}</option>
                  @endforeach
                @endforeach
              @endisset
            </select>
            <button>決定</button>
          </form>
        </div>
      </div>
      @endisset
      @isset($reserved_date)
      <div class="reserve__time-input">
        <span class="reserve__step">Step 3</span>
        <h2 class="reserve__search--title">◎から予約したい時間をお選びください</h2><br>
        @error('reserved')
          <p class="reserve__alert">{{$message}}</p>
        @enderror
        @error('date')
          <p class="reserve__alert">{{$message}}</p>
        @enderror
        <div class="reserve__search--box">
          <form method="get" action="{{route('reserve.confirm')}}">
            @csrf
            <div class="reserve__start-time">
              <span>開始：</span>
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
              <span>終了：</span>
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
            <button class="reserve__button">予約する</button>
          </form>
        </div>
      </div>
      @endisset
    </div>
    <div class="reserve__calendar">
      @empty($selected_s)
        <i class="fa-solid fa-circle-exclamation"></i>
        <p class="reserve__calendar--notice">使用機材・駐機スポットを決定するとカレンダーが表示されます</p><br>
      @endempty
      @if(!empty($selected_s))
        <i class="fa-solid fa-circle-exclamation"></i>
        <p class="reserve__calendar--notice">使用機材・駐機スポットを変更する場合は、<strong>再度必ず決定ボタンをクリック</strong>し、カレンダーを更新してください</p>
      @endif
      <div class="reserve__calendar--table">
        <table>
          <tr>
            <th></th>
            @for($i=0; $i<$open_days; $i++)
              <th>{{$calendar_row[$i]->format("m/d")}}</th>
            @endfor
          </tr>
          @for($i=0; $i<=$last_key; $i=$i+$open_days)
            <tr>
              <td class="reserve__calendar--date">{{$calendar_row[$i]->format("H:i")}}</td>
              @isset($reserved_date)
                @for($j=$i; $j<$i+$open_days; $j++)
                  @if(in_array($calendar_row[$j], $reserved_date)) 
                    <td class="reserve__unable">✕</td>
                  @else
                    <td>◎</td>
                  @endif
                @endfor
                <td class="reserve__calendar--date">{{$calendar_row[$i]->format("H:i")}}</td>
              @endisset
            </tr>
          @endfor
        </table>
      </div>
    </div>
  </div>
</main>
@endsection