@extends('layouts.airport_admin')

@section('contents')
<div class="aa_add__wrapper">
  <h2>航空機追加</h2>
  <div class="aa_add__outer">
    <form action=""></form>
      <div class="aa_add__inner">
        <span>航空機名：</span>
        <input type="text" name="name">
      </div>
      <div class="aa_add__inner">
        <input type="checkbox" name="spot_id">
      </div>
    </form>
  </div>
</div>
@endsection