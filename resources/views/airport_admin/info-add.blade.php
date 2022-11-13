@extends('layouts.airport_admin')

@section('contents')
<title>インフォメーション追加</title>
<div class="aa__wrapper">
  @error('title')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('text')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('success'))
    <p class="aa__notice">{{session('success')}}</p>
  @endif
  <div class="aa_add__outer">
    <h2>インフォメーション追加</h2>
    <form method="post" action="{{route('airport_admin.add_info')}}" >
    @csrf
      <div class="aa_add__inner aa_add__info">
        <span>タイトル</span>
        <input type="text" name="title">
        <p>※50文字以内</p>
      </div>
      <div class="aa_add__inner aa_add__info">
        <span>内容</span>
        <textarea name="text" rows="15"></textarea>
      </div>
      <button>追加</button>
    </form>
  </div>
</div>
@endsection