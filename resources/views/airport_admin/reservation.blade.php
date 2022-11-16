@extends('layouts.airport_admin')

@section('contents')
<title>予約確認</title>
<div class="aa_reservation__wrapper">
  <h2 class="aa_page-title">予約確認</h2>
  <form method="get" action="{{route('airport_admin.search')}}">
    @csrf
    <div class="aa_reservation__box aa_reservation__search">
      <div class="aa_reservation__search--inner">
        <span>日時</span>
        <input type="date" name="date" @isset($date) value="{{$date}}" @endisset>
      </div>
      <div class="aa_reservation__search--inner">
        <span>スポット</span>
        <select name="spot_id">
        @foreach ($spots as $spot)
          <option value="{{$spot->id}}" 
            @isset($selected_spot) 
            @if($selected_spot==$spot->id) selected 
            @endif @endisset>
            {{$spot->name}}
          </option>
        @endforeach
        </select>
      </div>
      <button>検索</button>
    </div>
  </form>
  @isset($result)
  @if($result->isEmpty())
  <div class="aa_reservation__box">
    <p>検索条件と一致する予約が見つかりません</p>
  </div>
  @else
  <div class="aa_reservation__box">
    <div class="aa_reservation__pagination">
      {{$result->appends(['spot_id' => $selected_spot, 'date' => $date])->links()}}
    </div>
    <table>
      <tr>
        <th>予約番号</th>
        <th>スポット</th>
        <th>使用航空機</th>
        <th>予約者</th>
        <th>電話番号</th>
        <th>使用日時(JST)(開始～終了)</th>
      </tr>
      @foreach($result as $r)
      <tr>
        <td>{{$r->id}}</td>
        <td>{{$r->spot->name}}</td>
        <td>{{$r->aircraft->name}}</td>
        <td>{{$r->user->name}}</td>
        <td>{{$r->user->tel}}</td>
        <td>{{$r->dateReform($r->start_at)}}～{{$r->dateReform($r->end_at)}}</td>
      </tr>
      @endforeach
    </table>
  </div>
  @endif
  @endisset
</div>
@endsection