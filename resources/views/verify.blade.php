@extends('layouts.layout')

@section('contents')
<div class="thanks__wrapper">
  <div class="thanks__contents">
    <form method="post" action="{{ route('verification.send') }}">
      @csrf
      <p>会員登録の際にお送りしたメールにて、<br>先にメールアドレスの認証をお願いいたします。</p>
      <p>メールが確認できない場合は、<br>以下のボタンを押してください。</p><br>
      <button>もう一度メールを送る</button>
    </form>
  </div>
</div>
@endsection