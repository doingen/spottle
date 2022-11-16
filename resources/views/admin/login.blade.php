@extends('layouts.admin')

@section('contents')
<title>管理者ログイン</title>
@if(session('result'))
<div class="admin__notice">
  <p>{{session('result')}}</p>
</div>
@endif
<div class="auth__box">
  <div class="auth__title">
    <h2>管理者ログイン</h2>
  </div>
  <div class="auth__item">
    <form method="post" action="{{route('admin.login')}}">
    @csrf
    @error('login_error')
      <p class="alert__notice login-error">{{$message}}</p>
    @enderror
      <div class="auth__item--inner">
        <div class="auth__input"> 
          <i class="fa-solid fa-envelope"></i>
          <input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
          @error('email')
            <p class="alert__notice">{{$message}}</p>
          @enderror
        </div>
        <div class="auth__input">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" placeholder="パスワード">
          @error('password')
            <p class="alert__notice">{{$message}}</p>
          @enderror
        </div>
        <div class="auth__bottom">
          <a href="{{route('admin.register')}}">管理者登録がまだの方はこちら</a>
          <button class="auth__button">ログイン</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection