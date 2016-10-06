@include('emails.layouts.head')

<table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
    <tr>
        <td align="left" style="padding: 20px">
            <p style="text-align: left">
                Вам необходимо активировать свой аккаунт. Перейдите по ссылке ниже:
            </p>
        </td>
    </tr>
</table>
<table style="border-left-color: red; border-left-style: solid;margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
    <tr>
        <td align="left" style="padding: 20px">
            <p style="text-align: left">
                <a href="{{ config('app.url') . '/activation/' . $code }}" target="_blank">{{ config('app.url') . '/activation/' . $code }}</a>
            </p>
        </td>
    </tr>
</table>
<table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
    <tr>
        <td align="left" style="padding: 20px">
            <p style="text-align: left">
                Код активации будет действителен в течение {{ config('app.activation_expiration') }} дней.
            </p>
        </td>
    </tr>
</table>

@include('emails.layouts.footer')