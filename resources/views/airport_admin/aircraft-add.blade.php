@extends('layouts.airport_admin')

@section('contents')
<title>航空機追加</title>
<div class="aa__wrapper">
  <div class="aa_add__outer">
    <h2>航空機追加</h2>
    <form method="post" action="{{route('airport_admin.add_aircraft')}}" >
    @csrf
      <div class="aa_add__inner">
        <span>航空機名</span>
        <input type="text" name="name">
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