<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('reset.css')}}">
  <link rel="stylesheet" href="{{asset('layout.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/99288424cc.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <a href="{{route('main.index')}}" class="app-name">
      <h1>スポっとる<i class="fa-regular fa-paper-plane fa-xs"></i></h1>
    </a>
    <nav>
      @if(Request::routeIs('mypage.index'))
        <a href="{{route('reserve.index')}}" class="header__reserve">予約する</a>
        <a href="{{route('logout')}}">ログアウト</a>
      @elseif(Auth::check())
        <a href="{{route('mypage.index')}}">マイページ</a>
        <a href="{{route('logout')}}">ログアウト</a>
      @else
        <a href="{{route('login.show')}}">ログイン</a>
        <a href="{{route('register.show')}}">会員登録</a>
      @endif
    </nav>
  </header>
  <main>
    @yield('contents')
  </main>
</body>
</html>