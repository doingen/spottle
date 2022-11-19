@extends('layouts.layout')

@section('contents')
<title>スポっとる</title>
<div class="main__outer">
  <div class="main__title-block">
    <img src="{{asset('storage/images/トップ背景.jpg')}}">
    <div class="main__title">
      <div class="main__title--item">
        <h2>松山空港</h2>
        <p>小型機スポット<br>予約サイト</p>
      </div>
      <a href="{{route('reserve.index')}}">予約する</a>
      <p class="main__title--notice">&#127818;要会員登録&#127818;</p>
    </div>
  </div>
  <div class="main__info">
    <h3 class="main__info--title">INFORMATION&#127818;</h3>
    <div class="main__info--contents">
      @foreach($info as $info)
      @php
        $created = substr($info->created_at, 0, 10);
        $date = str_replace('-', ".", $created);
      @endphp
      <div class="main__info--item">
        <span>{{$date}}</span>
        <a href="{{route('info.show', ['info_id' => $info->id])}}">
          <p>{{$info->title}}</p>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection