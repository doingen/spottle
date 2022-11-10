@extends('layouts.admin')

@section('contents')
<div class="admin_top__wrapper">
  <div class="admin_top__outer">
    <div class="admin_top__item">
      <div class="admin_top__item--title">
        <h2>管理者ログイン</h2>
      </div>
      <form method="post" action="{{route('admin.login')}}">
      @csrf
        <div class="auth__item--inner">
          @error('login_error')
            <p class="alert__notice login-error">{{$message}}</p>
          @enderror
          <div class="auth__input"> 
            <i class="fa-solid fa-envelope"></i>
            <input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
            @error('email')
              <p class="alert__notice">{{$message}}</p><br>
            @enderror
          </div>
          <div class="auth__input">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="パスワード">
            @error('password')
              <p class="alert__notice">{{$message}}</p><br>
            @enderror
          </div>
        </div>
        <button class="auth__button admin_top__button">ログイン</button>
      </form>
    </div>
    <div class="admin_top__item">
      <div class="admin_top__item--title">
        <h2>管理者登録</h2>
      </div>
      <form method="post" action="{{route('admin.register')}}">
      @csrf
        <div class="auth__item--inner">
          <div class="auth__input">
            @error('email')
              <p class="alert__notice">{{$message}}</p><br>
            @enderror  
            <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレス">
          </div>
          <div class="auth__input">
            @error('password')
              <p class="alert__notice">{{$message}}</p><br>
            @enderror
            @error('confirmed')
              p class="alert__notice">{{$message}}</p><br>
            @enderror
            <i class="fa-solid fa-lock"></i><input type="text" name="password" placeholder="パスワード">
          </div>
          <div class="auth__input">
            <input type="text" name="password_confirmation" class="admin_top__password" placeholder="パスワード確認のためもう一度入力してください">
          </div>
        </div>
        <button class="auth__button register__button">登録</button>
      </form>
    </div>
  </div>
</div>
@endsection