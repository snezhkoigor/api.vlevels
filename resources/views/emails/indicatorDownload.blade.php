<?php

$style = [
    'justify' => 'text-align: justify',
    'p-button' => 'text-align: center; padding: 20px;',
    'p-button-a' => 'text-decoration: none; color: black;',
    'p-button-a-span' => 'cursor: pointer; text-align: center; padding: 20px; background-color: #ffc801; width: 200px;'
];

?>

@extends('emails.layouts.system')

@section('content')
    <p>
        Здравствуйте!
    </p>
    <p style="{{$style['justify']}}">
        Мы выражаем большую благодарность за то, что Вы заинтересовались нашим продуктом, индикатором {{$indicatorName}}, поэтому скорее хотим вручить его Вам.
    </p>
    <p style="{{$style['p-button']}}">
        <a href="{{ config('app.url') . '/download.php?id=' . $indicatorId . '&email=' . $email }}" target="_blank" style="{{$style['p-button-a']}}">
            <span style="{{$style['p-button-a-span']}}">
                Скачать индикатор
            </span>
        </a>
    </p>
    <p style="{{$style['justify']}}">
        Ключ для использования индикатора мы отправили Вам на указанный номер телефона {{$phoneNumber}}.<br/><br/>
        Если по какой то причине Вы не получили ключ, Вы можете это сделать повторно, пройдя по этой ссылке:<br/><br/>
        {{ config('app.url') . '/download.php?id=' . $indicatorId . '&email=' . $email }}<br/><br/>
        Надеемся, что индикатор будет Вам полезен.<br/>
    </p>
@stop