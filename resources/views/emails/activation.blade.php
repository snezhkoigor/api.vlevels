@include('emails.layouts.head')

<table style="padding-top: 20px; margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <p style="text-align: left">
                Здравствуйте!
            </p>
            <p style="text-align: left">
                Вам необходимо активировать свой аккаунт. Используйте код ниже:
            </p>
            <p style="text-align: left">
                {{ $code }}
            </p>
            <p style="text-align: left">
                Код активации будет действителен в течение {{ config('app.activation_expiration') }} дней.
            </p>
        </td>
    </tr>
</table>

@include('emails.layouts.footer')