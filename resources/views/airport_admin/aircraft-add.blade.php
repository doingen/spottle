@extends('layouts.airport_admin')

@section('contents')
<title>航空機データ</title>
<div class="aa_add__wrapper">
  <div class="aa_add__outer">
  @error('name')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('spot_id')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('success'))
    <p class="aa__alert aa__notice">{{session('added_aircraft')}}{{session('success')}}</p>
  @endif
    <h2 class="aa__page-title">航空機追加</h2>
    <form method="post" action="{{route('airport_admin.add_aircraft')}}" >
    @csrf
      <div class="aa_add__inner">
        <span>航空機名</span>
        <input type="text" name="name" value="{{old('name')}}" class="aa_add__input">
      </div>
      <div class="aa_add__inner">
        <span>駐機可能スポット</span>
        <div class="aa_add__spot">
          @foreach($spots as $key=>$spot)
            <input type="checkbox" name="spot_id[]" id="key{{$key}}" value="{{$spot->id}}">
            <label for="key{{$key}}">{{$spot->name}}</label>
          @endforeach
          <p>※複数選択可</p>
        </div>
      </div>
      <button>追加</button>
    </form>
  </div>
  <div class="aa_add__outer">
  @error('changed_name')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('changed_spot_id')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('changed_success'))
    <p class="aa__alert aa__notice">{{session('changed_success')}}</p>
  @endif
  @error('changed_error')
    <p class="aa__alert">{{$message}}</p>
  @enderror
    <h2 class="aa_page-title">データ編集</h2>
    <form method="get" action="{{route('airport_admin.change_aircraft')}}">
      @csrf
      <div class="aa_add__inner">
        <span>変更する航空機データ</span>
        <select name="aircraft_id">
          <option value=""></option>
          @foreach($aircraft as $aircraft)
            <option value="{{$aircraft->id}}" 
            @isset($selected) @if($selected->id == $aircraft->id) selected 
            @endif @endisset>
              {{$aircraft->name}}
            </option>
          @endforeach
        </select>
        <button class="aa_change__button">表示</button>
      </div>
    </form>
    <form method="post" action="{{route('airport_admin.change_aircraft')}}">
      @csrf
      <div class="aa_add__inner">
        <span>航空機名</span>
        <input type="text" name="changed_name" class="aa_add__input"
        @if (old('changed_name')) value="{{old('changed_name')}}" 
        @elseif ($selected) value="{{$selected->name}}" 
        @endif>
      </div>
      <div class="aa_add__inner">
        <span>駐機可能スポット</span>
        <div class="aa_add__spot">
          @foreach($spots as $key => $spot)
            <input type="checkbox" name="changed_spot_id[]" id={{$key}} value="{{$spot->id}}" 
            @isset($selected) @if(in_array($spot->id, $selected_spot)) checked 
            @endif @endisset>
            <label for="{{$key}}">{{$spot->name}}</label>
          @endforeach
          <p>※複数選択可</p>
        </div>
      </div>
      @isset($selected)
        <input type="hidden" name="aircraft_id" value="{{$selected->id}}">
      @endisset
      <button>変更</button>
    </form>
  </div>
</div>
@endsection