@extends('layouts.layout')

@section('contents')
<title>会員登録</title>
<div class="auth__box">
  <div class="auth__title">
    <h2>会員登録</h2>
  </div>
  <div class="auth__item">
    <form method="post" action="">
    @csrf
      <div class="auth__item--inner">
        <div class="auth__input">
          @error('name')
            <p class="alert_notice">{{$message}}</p><br>
          @enderror
          <i class="fa-solid fa-user"></i><input type="text" name="name" value="{{old('name')}}" placeholder="お名前">
        </div>
        <div class="auth__input">
          @error('email')
            <p class="alert_notice">{{$message}}</p><br>
          @enderror  
          <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
        </div>
        <div class="auth__input">
          @error('tel')
            <p class="alert_notice">{{$message}}</p><br>
          @enderror
          <i class="fa-solid fa-phone"></i><input type="text" name="tel" value="{{old('tel')}}" placeholder="電話番号">
        </div>
        <div class="auth__input">
          @error('password')
            <p class="alert_notice">{{$message}}</p><br>
          @enderror
          <i class="fa-solid fa-lock"></i><input type="text" name="password" placeholder="パスワード">
        </div>
      </div>  
      <button class="auth__button register__button">登録</button>
    </form>
  </div>
</div>
@endsection