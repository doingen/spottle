@component('mail::message')

@if (!empty($user->name))
    {{ $user->name }} 様
@endif

会員登録登録ありがとうございます！
以下の認証リンクをクリックしてください。

@component('mail::button', ['url' => $url])
メールアドレスを認証する
@endcomponent


もし、このメールに覚えが無い場合は破棄をお願いいたします。


@if (!empty($url))
「メールアドレスを認証する」ボタンがクリックできない場合は、
下記のURLをコピーしてWebブラウザに貼り付けてください。

{{ $url }}
@endif

@endcomponent