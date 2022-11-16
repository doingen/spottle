@extends('layouts.layout')

@section('contents')
<title>登録内容確認</title>
<x-confirm>
  <x-slot name="title">登録内容</x-slot>
  <x-slot name="contents">
    <div class="confirm__inner--item">
      <span>お名前</span>
      <p>{{$register["name"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>メール</span>
      <p>{{$register["email"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>電話番号</span>
      <p>{{$register["tel"]}}</p>
    </div>
    <div class="confirm__inner--item">
      <span>パスワード</span>
      <p>安全のため表示しません</p>
    </div>
  </x-slot>
  <x-slot name="button">
    <a class="confirm__button--back" onclick="history.back(); return false;">戻る</a>
    <form method="post" action="{{route('register.create', ['register' => $register])}}" class="confirm__button--reserve">
    @csrf
      <button>登録</button>
    </form>
  </x-slot>
</x-confirm>
@endsection