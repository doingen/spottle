@extends('layouts.airport_admin')

@section('contents')
<title>スポット追加</title>
<div class="aa__wrapper">
  @error('name')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('success'))
    <p class="aa__notice">スポット{{session('added_spot')}}{{session('success')}}</p>
  @endif
  <div class="aa_add__outer">
    <h2>スポット追加</h2>
    <form method="post" action="{{route('airport_admin.add_spot')}}" >
    @csrf
      <div class="aa_add__inner">
        <span>スポット名</span>
        <input type="text" name="name">
        <p>※10文字以内</p>
      </div>
      <button>追加</button>
    </form>
  </div>
</div>
@endsection