@extends('layouts.layout')

@section('contents')
<title>ログイン</title>
<div class="auth__box">
  <div class="auth__title">
    <h2>ログイン</h2>
  </div>
  <div class="auth__item">
    @error('login_error')
      <p class="alert_notice">{{$message}}</p>
    @enderror
    <form method="post" action="">
    @csrf
      <div class="auth__item--inner">
        <div class="auth__input"> 
          <i class="fa-solid fa-envelope"></i>
          <input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
          @error('email'))
            <p class="alert_notice">{{$message}}</p><br>
          @enderror
        </div>
        <div class="auth__input">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" placeholder="パスワード">
          @error('password'))
            <p class="alert_notice">{{$message}}</p><br>
          @enderror
        </div>
        <div class="auth__bottom">
          <a href="{{route('register.show')}}">会員登録がまだの方はこちら</a>
          <button class="auth__button">ログイン</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection