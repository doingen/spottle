@extends('layouts.layout')

@section('contents')
<title>マイページ</title>
<div class="mypage__wrapper">
  <div class="mypage__outer">
    <h2 class="page-title">マイページ</h2>
    <section class="mypage__reserve">
      <h3>予約一覧</h3>
      <div class="mypage__reserve--inner">
        <table>
          <tr>
            <th>スポット</th>
            <th>使用機材</th>
            <th>開始</th>
            <th>終了</th>
          </tr>
          @foreach($reserve as $reserve)
          <tr>
            <td>{{$reserve->spot->name}}</td>
            <td>{{$reserve->aircraft->name}}</td>
            <td>{{$reserve->dateReform($reserve->start_at)}}</td>
            <td>{{$reserve->dateReform($reserve->end_at)}}</td>
          </tr>
          @endforeach
        </table>
      </div>
    </section>
    <section class="mypage__review">
      <h3>過去の利用履歴（直近３件）</h3>
      <div class="mypage__review--inner">
        <table>
          <tr>
            <th>スポット</th>
            <th>使用機材</th>
            <th>開始</th>
            <th>終了</th>
          </tr>
          @foreach($review as $review)
          <tr>
            <td>{{$review->spot->name}}</td>
            <td>{{$review->aircraft->name}}</td>
            <td>{{$review->dateReform($review->start_at)}}</td>
            <td>{{$review->dateReform($review->end_at)}}</td>
            <td><a href="">レビューを書く</a></td>
          </tr>
          @endforeach
        </table>
      </div>
    </section>
  </div>
</div>
@endsection