@extends('layouts.layout')

@section('contents')
<title>会員登録</title>
<div class="auth__wrapper">
  <div class="auth__box">
    <div class="auth__title">
      <h2>会員登録</h2>
    </div>
    <div class="auth__item">
      <form method="post" action="{{route('register.confirm')}}">
      @csrf
        <div class="auth__item--inner">
          @error('name')
            <p class="alert__notice">{{$message}}</p>
          @enderror
          <div class="auth__input">
            <i class="fa-solid fa-user"></i><input type="text" name="name" value="{{old('name')}}" placeholder="お名前">
          </div>
          @error('email')
            <p class="alert__notice">{{$message}}</p>
          @enderror  
          <div class="auth__input">
            <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
          </div>
          @error('tel')
            <p class="alert__notice">{{$message}}</p>
          @enderror
          <p class="auth__input--notice">※ハイフン「-」なし</p>
          <div class="auth__input">
            <i class="fa-solid fa-phone"></i><input type="text" name="tel" value="{{old('tel')}}" placeholder="電話番号">
          </div>
          @error('password')
            <p class="alert__notice">{{$message}}</p>
          @enderror
          <div class="auth__input">
            <i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="パスワード">
          </div>
          <div class="auth__input">
            <input type="password" name="password_confirmation" class="auth__password-confirm" placeholder="再度パスワード入力">
          </div>
        </div>  
        <button class="auth__button register__button">登録</button>
      </form>
    </div>
  </div>
</div>
@endsection