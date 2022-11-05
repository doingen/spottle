@extends('layouts.layout')

@section('contents')
<title>マイページ</title>
<div class="mypage__wrapper">
  <div class="mypage__outer">
    <x-title title="マイページ" />
    <div class="mypage__inner">
      <section class="mypage__contents">
        <h3>予約一覧</h3>
        <div class="mypage__contents--inner">
          <table>
            <tr>
              <th>予約番号</th>
              <th>スポット</th>
              <th>使用機材</th>
              <th>開始</th>
              <th>終了</th>
            </tr>
            @foreach($reserve as $reserve)
            <tr>
              <td>{{$reserve->id}}</td>
              <td>{{$reserve->spot->name}}</td>
              <td>{{$reserve->aircraft->name}}</td>
              <td>{{$reserve->dateReform($reserve->start_at)}}</td>
              <td>{{$reserve->dateReform($reserve->end_at)}}</td>
              <td class="mypage__reserve">
                @if($reserve->start_at >= now())
                  <a href="{{route('reserve.show', ['reserve_id' => $reserve->id])}}">日時変更する</a>
                @endif
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </section>
      <section class="mypage__contents">
        <h3>過去の利用履歴（直近３件）</h3>
        <div class="mypage__contents--inner">
          <table>
            <tr>
              <th>予約番号</th>
              <th>スポット</th>
              <th>使用機材</th>
              <th>開始</th>
              <th>終了</th>
            </tr>
            @foreach($review as $review)
            <tr>
              <td>{{$review->id}}</td>
              <td>{{$review->spot->name}}</td>
              <td>{{$review->aircraft->name}}</td>
              <td>{{$review->dateReform($review->start_at)}}</td>
              <td>{{$review->dateReform($review->end_at)}}</td>
              <td class="mypage__review"><a href="">レビューを書く</a></td>
            </tr>
            @endforeach
          </table>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection