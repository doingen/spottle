<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('css/layout.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/99288424cc.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <a href="{{route('admin.index')}}" class="app-name">
      <h1>スポっとる<i class="fa-regular fa-paper-plane fa-xs"></i></h1>
      <span class="admin__title">管理者ページ</span>
    </a>
    <nav>
      @if(Auth::guard('admin')->check())
        <a href="{{route('admin.logout')}}">ログアウト</a>
      @endif
    </nav>
  </header>
  <main>
    @yield('contents')
  </main>
</body>
</html>