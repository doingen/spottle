@extends('layouts.airport_admin')

@section('contents')
<title>スポット追加</title>
<div class="aa_add__wrapper">
  <div class="aa_add__outer">
  @error('name')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('success'))
    <p class="aa__alert aa__notice">スポット{{session('added_spot')}}{{session('success')}}</p>
  @endif
    <h2 class="aa_page-title">スポット追加</h2>
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
  <div class="aa_add__outer">
  @error('changed_name')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('changed_success'))
    <p class="aa__alert aa__notice">{{session('changed_success')}}</p>
  @elseif(session('changed_error'))
    <p class="aa__alert">{{session('changed_error')}}</p>
  @endif
    <h2 class="aa_page-title">スポット名変更</h2>
    <form method="post" action="{{route('airport_admin.change_spot')}}" >
    @csrf
      <div class="aa_add__inner">
        <span>変更スポット</span>
        <select name="changed_spot_id">
          @foreach($spots as $spot)
            <option value="{{$spot->id}}">{{$spot->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="aa_add__inner">
        <span>変更後スポット名</span>
        <input type="text" name="changed_name" @if(session('input')) value="{{session('input')}}" @endif>
        <p>※10文字以内</p>
      </div>
      <button>変更</button>
    </form>
  </div>
</div>
@endsection