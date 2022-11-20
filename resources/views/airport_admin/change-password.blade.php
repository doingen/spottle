@extends('layouts.airport_admin')

@section('contents')
<title>新しくパスワード設定する</title>
<div class="aa_auth__wrapper">
  <div class="auth__box">
    <div class="auth__title">
      <h2>新しくパスワード設定する</h2>
    </div>
    <div class="auth__item">
      <form method="post" action="{{route('airport_admin.login.update')}}">
      @csrf
        <div class="auth__item--inner">
          @error('password')
            <p class="alert__notice">{{$message}}</p>
          @enderror
          @if(session('error'))
            <p class="alert__notice">{{session('error')}}</p>
          @endif
          <div class="auth__input">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="パスワード">
          </div>
          <div class="auth__input">
            <input type="password" name="password_confirmation" class="aa_auth__password-confirm" placeholder="再度パスワード入力">
          </div>
          <input type="hidden" name="id" value="{{$user}}"}}>
          <p class="aa_auth__notice">※初期パスワードと同じパスワードを使用しないでください</p>
          <div class="auth__bottom">
            <button class="auth__button">設定</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection