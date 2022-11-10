@extends('layouts.admin')

@section('contents')
<title>管理者登録</title>
<div class="auth__box">
  <div class="auth__title">
    <h2>管理者登録</h2>
  </div>
  <div class="auth__item">
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
            <p class="alert__notice">{{$message}}</p><br>
          @enderror
          <i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="パスワード">
          <input type="password" name="password_confirmation" class="admin__password-confirm" placeholder="確認のため、再度パスワードを入力してください">
        </div>
      </div>  
      <button class="auth__button register__button">登録</button>
    </form>
  </div>
</div>
@endsection