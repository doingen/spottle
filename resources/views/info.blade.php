@extends('layouts.layout')

@section('contents')
<title>{{$info->title}}</title>
<div class="info__wrapper">
  <div class="info__title">
    @php
        $created = substr($info->created_at, 0, 10);
        $date = str_replace('-', ".", $created);
    @endphp
    <span>{{$date}}</span><br>
    <h2>{{$info->title}}</h2>
  </div>
  <div class="info__contents">
    <p>{{$info->text}}</p>
  </div>
  <div class="info__button">
    <div class="info__button--article">
      @if($info->id != 1)
        <a href="{{route('info.show', ['info_id' => $info->id-1])}}"><i class="fas fa-arrow-left"></i> 以前の記事へ</a>
      @endif
      @if($info->id != $latest->id)
        <a href="{{route('info.show', ['info_id' => $info->id+1])}}">次の記事へ <i class="fas fa-arrow-right"></i></a>
      @endif
    </div>
    <div class="info__button--top">
      <a href="{{route('main.index')}}">トップへ</a>
    </div>
  </div>
</div>
@endsection