<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
</head>
<body style="margin: 0; padding: 0; min-width: 100%; background-color: #ffffff; font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;">
    <center style="width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
        <div style="max-width: 600px;">
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" style="border-collapse: collapse;">
                <tr>
                    <td>
            <![endif]-->
            <table align="center" style="margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; color: #333333;">
                <tr>
                    <td style="background: url('{{config('app.url') . '/img/static/header-bg.jpg'}}') 100% 100%;">
                        <table width="100%" class="header" style="padding: 15px;">
                            <tr>
                                <td style="width: 80px;">
                                    <img src="{{config('app.url') . '/img/static/logo.png'}}" alt="" />
                                </td>
                                <td style="color: white; font-size: 14px; padding-top: 25px;">
                                    {{config('app.name')}}
                                </td>
                                <td style="font-size: 14px; float: right; padding-top: 7px;">
                                    <table>
                                        <tr>
                                            <td style="padding: 3px;">
                                                <img src="{{config('app.url') . '/img/static/ico-site.png'}}" style="float: right;" />
                                            </td>
                                            <td style="padding: 3px;">
                                                &nbsp;<a style="color: white;" href="{{config('app.websiteUrl')}}" target="_blank">{{config('app.websiteUrl')}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 3px;">
                                                <img src="{{config('app.url') . '/img/static/ico-mail.png'}}" style="float: right;" />
                                            </td>
                                            <td style="padding: 3px;">
                                                &nbsp;<a style="color: white;" href="mailto:{{config('app.supportEmail')}}">{{config('app.supportEmail')}}</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%">
                            <tr>
                                <td style="text-align: left; padding: 10px;">