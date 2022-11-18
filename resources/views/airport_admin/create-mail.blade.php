@extends('layouts.airport_admin')

@section('contents')
<title>メール作成</title>
<div class="aa__wrapper">
  @error('subject')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('text')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('error'))
    <p class="aa__alert">{{session('error')}}</p>
  @endif
  <div class="aa_mail__outer">
    <form method="post" action="{{route('airport_admin.mail.confirm')}}">
      @csrf
      <h2 class="aa__page-title">メール作成</h2>
      <div class="aa_mail__inner">
        <div class="aa_mail__item aa_mail__item--to">
          <span>TO</span>
          <p>利用者全員</p>
        </div>
        <div class="aa_mail__item aa_mail__item--subject">
          <span>件名</span>
          <input type="text" name="subject" value="{{old('subject')}}">
        </div>
        <div class="aa_mail__item aa_mail__item--contents">
          <textarea name="text" rows="10" placeholder="テキスト">{{old('text')}}</textarea>
        </div>
        <button>送信内容確認</button>
      </div>
    </form>
  </div>
</div>
@endsection