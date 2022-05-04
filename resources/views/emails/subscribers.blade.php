@component('mail::message')
# Kipper App

Dear {{$firstName}}, <br>
This is to notify you that your item with name <strong>{{$name}}</strong> <br>
is expiring on <strong>{{$expiryDate}}</strong>

@component('mail::button', ['url' => ''])
Go to site
@endcomponent

Thanks,<br>
<strong>Kipper Team</strong>
{{--{{ config('app.name') }}--}}
@endcomponent
