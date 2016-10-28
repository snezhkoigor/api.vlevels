@extends('emails.layouts.system')

@section('content')
    <p>
        Здравствуйте!
    </p>
    <p>
        Вам необходимо активировать свой аккаунт. Используйте код ниже:
    </p>
    <p>
        {{ $code }}
    </p>
    <p>
        Код активации будет действителен в течение {{config('app.activation_expiration')}} дней.
    </p>
@stop