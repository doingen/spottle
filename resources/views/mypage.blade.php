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
        @if($reserve->isEmpty())
          <p class="mypage__nothing">予約情報はありません</p>
        @else
          <table>
            <colgroup>
              <col style="width: 6%;">
              <col style="width: 8%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 4%;">
              <col style="width: 4%;">
            </colgroup>
            <tr>
              <th>予約番号</th>
              <th>スポット</th>
              <th>使用機材</th>
              <th>開始(JST)</th>
              <th>終了(JST)</th>
              <th>変更</th>
              <th>取消</th>
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
                    <a href="{{route('reserve.show', ['reserve_id' => $reserve->id])}}"><i class="fa-solid fa-pencil"></i></a>
                @endif
              </td>
              <td class="mypage__reserve">
                @if($reserve->start_at >= now())
                  <a href="{{route('reserve.delete', ['reserve_id' => $reserve->id])}}"><i class="fa-solid fa-xmark"></i></a>
                @endif
              </td>
            </tr>
            @endforeach
          </table>
        @endif
        </div>
      </section>
      <section class="mypage__contents">
        <h3>過去の利用履歴（直近３件）</h3>
        <div class="mypage__contents--inner">
        @if($review->isEmpty())
          <p class="mypage__nothing">利用履歴はありません</p>
        @else
          <table>
            <colgroup>
              <col style="width: 5%;">
              <col style="width: 8%;">
              <col style="width: 10%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 5%;">
            </colgroup>
            <tr>
              <th>予約番号</th>
              <th>スポット</th>
              <th>使用機材</th>
              <th>開始(JST)</th>
              <th>終了(JST)</th>
              <th>レビュー</th>
            </tr>
            @foreach($review as $review)
            <tr>
              <td>{{$review->id}}</td>
              <td>{{$review->spot->name}}</td>
              <td>{{$review->aircraft->name}}</td>
              <td>{{$review->dateReform($review->start_at)}}</td>
              <td>{{$review->dateReform($review->end_at)}}</td>
              <td class="mypage__review">
                @if($review->reviewedOrNot($review->id))
                  <a href="{{route('review.show', ['reservation_id' => $review->id])}}"><i class="fa-regular fa-pen-to-square"></i></a>
                @else
                  <p>済</p>
                @endif
              </td>
            </tr>
            @endforeach
          </table>
        @endif
        </div>
      </section>
    </div>
  </div>
</div>
@endsection