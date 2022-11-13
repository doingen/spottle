@extends('layouts.airport_admin')

@section('contents')
<title>航空機追加</title>
<div class="aa__wrapper">
  @error('name')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('spot_id')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('success'))
    <p class="aa__notice">{{session('added_aircraft')}}{{session('success')}}</p>
  @endif
  <div class="aa_add__outer">
    <h2>航空機追加</h2>
    <form method="post" action="{{route('airport_admin.add_aircraft')}}" >
    @csrf
      <div class="aa_add__inner">
        <span>航空機名</span>
        <input type="text" name="name" value="{{old('name')}}">
      </div>
      <div class="aa_add__inner">
        <span>駐機可能スポット</span>
        @foreach($spots as $key=>$spot)
          <input type="checkbox" name="spot_id[]" id="key{{$key}}" value="{{$spot->id}}">
          <label for="key{{$key}}">{{$spot->name}}</label>
        @endforeach
        <p>※複数選択可</p>
      </div>
      <button>追加</button>
    </form>
  </div>
</div>
@endsection