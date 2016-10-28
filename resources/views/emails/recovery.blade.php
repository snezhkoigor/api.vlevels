@extends('emails.layouts.system')

@section('content')
    <p>
        Здравствуйте!
    </p>
    <p>
        Ваш пароль был успешно изменен. Для авторизации используйте пароль ниже:
    </p>
    <p>
        {{$password}}
    </p>
@stop