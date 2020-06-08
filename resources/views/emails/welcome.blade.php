@component('mail::message')
# Hoşgeldiniz

{{$name}}

Teşekkür Ederiz,<br>
{{ config('app.name') }}
@endcomponent
