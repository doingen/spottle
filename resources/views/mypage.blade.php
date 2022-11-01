@extends('layouts.layout')

@section('contents')
<title>マイページ</title>
<div class="mypage__wrapper">
  <div class="mypage__outer">
    <h2>マイページ</h2>
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
          @foreach($user as $user)
          <tr>
            
            <td>{{$user->spot->name}}</td>
            <td>{{$user->aircraft->name}}</td>
            <td>{{$user->dateReform($user->start_at)}}</td>
            <td>{{$user->dateReform($user->end_at)}}</td>
          </tr>
          @endforeach
        </table>
      </div>
    </section>
    <section class="mypage__review">
      <h3>口コミを書く</h3>
    </section>
  </div>
</div>
@endsection