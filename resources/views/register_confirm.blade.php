@extends('layouts.layout')

@section('contents')
<title>登録内容確認</title>
<x-confirm>
  <x-slot name="title">登録内容</x-slot>
  <x-slot name="attribute">
    <p>お名前</p>
    <p>メールアドレス</p>
    <p>電話番号</p>
    <p>パスワード</p>
  </x-slot>
  <x-slot name="contents">
    <p>{{$register["name"]}}</p>        
    <p>{{$register["email"]}}</p>
    <p>{{$register["tel"]}}</p>
    <p>安全のため表示しません</p>
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