@extends('layouts.admin')

@section('contents')
<div class="admin__wrapper">
  @if(session('result'))
    <div class="admin__notice">
      <p>{{session('result')}}</p>
    </div>
  @endif
  <div class="admin__outer">
    <div class="admin__title--add">
      <h2>空港管理者追加</h2>
    </div>
    <div class="auth__item">
      <form method="post" action="{{route('admin.create')}}">
      @csrf
        <div class="auth__item--inner">
          @error('name')
            <p class="alert__notice">{{$message}}</p>
          @enderror
          <div class="auth__input">
            <i class="fa-solid fa-user"></i><input type="text" name="name" value="{{old('name')}}" placeholder="空港管理者名">
          </div>
          @error('email')
            <p class="alert__notice">{{$message}}</p>
          @enderror 
          <div class="auth__input"> 
            <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
          </div>
        </div>  
        <button class="auth__button register__button">登録</button>
      </form>
    </div>
  </div>
</div>
@endsection