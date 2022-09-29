<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('css/layout.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <h1>スポっとる</h1>
    <nav>
      @if(Auth::check())
        <a href="">マイページ</a>
        <a href="">ログアウト</a>
      @else
        <a href="">ログイン</a>
        <a href="">会員登録</a>
      @endif
    </nav>
  </header>
  @yield('contents')
</body>
</html>