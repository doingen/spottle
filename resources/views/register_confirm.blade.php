@extends('layouts.layout')

@section('contents')
<title>登録内容確認</title>
<div class="confirm__wrapper">
  <h2>登録内容</h2>
  <div class="confirm__contents">
    <div class="confirm__contents--left">
      <p>お名前</p>
      <p>メールアドレス</p>
      <p>電話番号</p>
      <p>パスワード</p>
    </div>
    <div class="confirm__contents--right">
      <p>{{$register["name"]}}</p>        
      <p>{{$register["email"]}}</p>
      <p>{{$register["tel"]}}</p>
      <p>安全のため表示しません</p>
    </div>
  </div>
  <div class="confirm__button">
    <a class="confirm__button--back" onclick="history.back(); return false;">戻る</a>
    <form method="post" action="{{route('register.create', ['register' => $register])}}" class="confirm__button--reserve">
    @csrf
      <button>登録</button>
    </form>
  </div>
</div>
@endsection