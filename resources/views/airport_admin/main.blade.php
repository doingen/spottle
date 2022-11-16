@extends('layouts.airport_admin')

@section('contents')
<title>空港管理者ページ</title>
<div class="aa__wrapper">
  @if(session('result'))
    <p class="aa__notice--login">{{session('result')}}</p>
  @endif
  <h2>メニュー&#x1f34a;</h2>
  <div class="aa_main__outer">
    <a href="{{route('airport_admin.mail')}}" class="aa_main__item">
      <p><i class="fa-solid fa-envelope fa-lg"></i>メール作成</p>
    </a>
    <a href="{{route('airport_admin.add_aircraft')}}" class="aa_main__item">
      <p><i class="fa-solid fa-plane fa-lg"></i>航空機追加</p>
    </a>
    <a href="{{route('airport_admin.add_info')}}" class="aa_main__item">
      <p><i class="fa-solid fa-circle-info fa-lg"></i>インフォメーション追加</p>
    </a>
    <a href="{{route('airport_admin.add_spot')}}" class="aa_main__item">
      <p><i class="fa-solid fa-plane-circle-check fa-lg"></i>スポット追加</p>
    </a>
  </div>
</div>
@endsection