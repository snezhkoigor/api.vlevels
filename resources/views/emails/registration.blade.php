<?php

$style = [
    'justify' => 'text-align: justify'
];

?>

@extends('emails.layouts.system')

@section('content')
    <p>
        Здравствуйте!
    </p>
    <p style="{{$style['justify']}}">
        Вы успешно зарегистрировались в {{config('app.name')}} - системе анализа отчетов товарной биржи CME Group.
    </p>
    <p style="{{$style['justify']}}">
        Для ознакомления с возможностями сайта <a href='{{config('app.website_url')}}' target="_blank">{{config('app.name')}}</a> и программами для торгового терминала, на одну неделю Вам предоставляетя бесплатный демонстрационный доступ.
    </p>
    <p style="{{$style['justify']}}">
        Что бы воспользоваться программами, введите свой адрес электронный почты и ключ в соответствующие поля индикатора.
    </p>
    <p style="{{$style['justify']}}">
        Логин для авторизации в кабинете: <b>{{$email}}</b>
    </p>
    <p style="{{$style['justify']}}">
        Пароль авторизации в кабинете: <b>{{$password}}</b>
    </p>
    <p style="{{$style['justify']}}">
        Ключ для программ сервиса: <b>{{$indicatorKey}}</b>
    </p>
    <p style="{{$style['justify']}}">
        Благодарим Вас за регистрацию, и надеемся что {{config('app.name')}} будет полезен и удобен в использовании.
    </p>
@stop