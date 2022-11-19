@extends('layouts.layout')

@section('contents')
<title>レビュー作成</title>
<div class="review__wrapper">
  <div class="review__outer">
    <x-title title="レビュー作成" />
    <div class="review__inner">
      @foreach($reservation as $r)
      <form method="post" action="{{route('review.create', ['reservation_id'=> $r->id])}}">
        @csrf
        <div class="review__info">
          <div class="review__info--contents">
            <span>予約番号</span><p>{{$r->id}}</p>
          </div>
          <div class="review__info--contents">
            <span>使用機材</span><p>{{$r->aircraft->name}}</p>
          </div>
          <div class="review__info--contents">
            <span>使用スポット</span><p>{{$r->spot->name}}</p>
          </div>
        </div>
        <div class="review__inner--item">
          <select name="stars">
            @for($i=1; $i<=5; $i++)
              @php $star = "⭐"; @endphp
              <option value="{{$i}}">{{str_repeat($star, $i)}}</option>
            @endfor
          </select>
        </div>
        <div class="review__inner--item">
          <p>コメント<i class="fa-regular fa-pen-to-square"></i></p>
          @error('comment')
            <p class="alert__notice">{{$message}}</p>
          @enderror
          <textarea name="comment" cols="50" rows="5" maxlength="190"></textarea>
          <p><i class="fa-solid fa-circle-exclamation"></i>レビューは、1つの予約に対して1回のみ投稿可能です。</p>
          <p><i class="fa-solid fa-circle-exclamation"></i>一度投稿したレビューは変更できませんので、投稿前に内容をよく確認してください。</p>
        </div>
        <button>投稿</button>
      </form>
      @endforeach
    </div>
  </div>
</div>

@endsection