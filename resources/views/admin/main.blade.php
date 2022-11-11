@extends('layouts.admin')

@section('contents')
<div class="admin__wrapper">
  <div class="admin__outer">
    <h2>空港管理者追加</h2>
    <div class="admin__inner">
      <div class="auth__item">
        <form method="post" action="{{route('admin.register')}}">
        @csrf
          <div class="auth__item--inner">
            <div class="auth__input">
              @error('name')
                <p class="alert__notice">{{$message}}</p><br>
              @enderror
              <i class="fa-solid fa-user"></i><input type="text" name="name" value="{{old('name')}}" placeholder="空港管理者名">
            </div>
            <div class="auth__input">
              @error('email')
                <p class="alert__notice">{{$message}}</p><br>
              @enderror  
              <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
            </div>
          </div>  
          <button class="auth__button register__button">登録</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection