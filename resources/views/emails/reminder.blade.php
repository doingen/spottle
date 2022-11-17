@component('mail::message')

{{$user->name}} 様


いつもご利用、誠にありがとうございます。


本日、松山空港にてスポット予約がございますので、お知らせいたします。


詳細は、以下マイページよりご確認ください。

@isset($url)
@component('mail::button', ['url' => $url, 'color' => 'primary'])
マイページ
@endcomponent
@endisset

@endcomponent