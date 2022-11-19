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
          <div class="auth__input">
            @error('name')
              <p class="alert__notice">{{$message}}</p>
            @enderror
            <i class="fa-solid fa-user"></i><input type="text" name="name" value="{{old('name')}}" placeholder="お名前">
          </div>
          <div class="auth__input">
            @error('email')
              <p class="alert__notice">{{$message}}</p>
            @enderror  
            <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
          </div>
          <div class="auth__input">
            @error('tel')
              <p class="alert__notice">{{$message}}</p>
            @enderror
            <i class="fa-solid fa-phone"></i><input type="text" name="tel" value="{{old('tel')}}" placeholder="電話番号">
            <p>※ハイフン「-」なし</p>
          </div>
          <div class="auth__input">
            @error('password')
              <p class="alert__notice">{{$message}}</p>
            @enderror
            <i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="パスワード">
            <input type="password" name="password_confirmation" class="auth__password-confirm" placeholder="再度パスワードを入力してください">
          </div>
        </div>  
        <button class="auth__button register__button">登録</button>
      </form>
    </div>
  </div>
</div>
@endsection