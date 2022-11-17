@component('mail::message')
{{$text}}

@isset($url)
@component('mail::button', ['url' => $url, 'color' => 'primary'])
{{ config('app.name') }}
@endcomponent
@endisset

@endcomponent