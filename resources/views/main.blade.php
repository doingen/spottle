@extends('layouts.layout')

@section('contents')
<script src="https://kit.fontawesome.com/99288424cc.js" crossorigin="anonymous"></script>
<title>スポっとる</title>
<main>
    <div class="main__wrapper">
    <div class="main__outer">
      <div class="main__title-block">
        <img src="{{asset('img/トップ背景.jpeg')}}">
        <div class="main__title">
          <h2>松山空港</h2>
          <p>小型機スポット<br>予約サイト</p>
          <a href="">予約する</a>
        </div>
      </div>
      <div class="main__info">
        <h3 class="main__info--title">INFORMATION&#127818;</h3>
        <div class="main__info--contents">
          <div class="main__info--item">
            <span>2022.9.19</span>
            <p>テスト</p>
            <a href=""><i class="fas fa-arrow-right"></i></a>
          </div>
          <div class="main__info--item">
            <span>2022.9.19</span>
            <p>テスト</p>
            <a href=""><i class="fas fa-arrow-right"></i></a>
          </div>
          <div class="main__info--item">
            <span>2022.9.19</span>
            <p>テスト</p>
            <a href=""><i class="fas fa-arrow-right"></i></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection