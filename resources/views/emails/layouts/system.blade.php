<?php
    $style = [
        'body' => 'margin: 0; padding: 0; min-width: 100%; background-color: #ffffff; font-family: "Droid Sans", "Helvetica Neue", "Arial", "sans-serif" !important;',
        'center' => 'width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;',
        'center-div' => 'max-width: 600px;',
        'gte-mso-9-table' => 'border-collapse: collapse;',
        'table-outer' => 'margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; color: #333333;',
        'td-head-background-image' => 'background: url(' . config('app.url') . '/img/static/header-bg.jpg' . ') 100% 100%;',
        'table-header' => 'padding: 15px;',
        'td-project-logo' => 'background: url(' . config('app.url') . '/img/static/logo.png' . ') 100% 100% no-repeat;  width: 155px; background-position: inherit;',
        'td-project-logo-div' => 'padding-left: 60px; padding-top: 28px; color: white; font-size: 14px;',
        'project-links' => 'font-size: 14px; float: right;',
        'project-links-td' => 'padding: 3px;',
        'project-links-img' => 'float: right; padding-top: 3px;',
        'content-td' => 'text-align: left; padding: 10px;',
        'footer-regards' => 'text-align: left; padding: 10px; font-size: 13px; font-style: italic; padding-top: 30px;',
        'footer-hr' => 'border: none; color: #b1aeae; background-color: #b1aeae; height: 1px; margin-top: 10px; margin-bottom: 10px;',
        'footer-hr-td' => 'text-align: left; padding: 10px;',
        'footer-unsubscribe-td' => 'text-align: left; padding: 10px; font-size: 13px;',
        'footer-unsubscribe-a' => 'color: #ee6a56; text-decoration: underline;',
        'website-url' => 'color: white;',
        'support-email' => 'color: white;'
    ];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}}</title>
    </head>
    <body style="{{$style['body']}}">
        <center style="{{$style['center']}}">
            <div style="{{$style['center-div']}}">
                <!--[if (gte mso 9)|(IE)]>
                <table width="600" align="center" style="{{$style['gte-mso-9-table']}}">
                    <tr>
                        <td>
                <![endif]-->
                <table class="outer" align="center" style="{{$style['table-outer']}}">
                    <tr>
                        <td class="head-background-image" style="{{$style['td-head-background-image']}}">
                            <table width="100%" class="header" style="{{$style['table-header']}}">
                                <tr>
                                    <td class="project-logo" style="{{$style['td-project-logo']}}">
                                        <div style="{{$style['td-project-logo-div']}}">
                                            {{config('app.name')}}
                                        </div>
                                    </td>
                                    <td class="project-links" style="{{$style['project-links']}}">
                                        <table>
                                            <tr>
                                                <td style="{{$style['project-links-td']}}">
                                                    <img class="website" src="{{config('app.url') . config('app.images_storage') . 'ico-site.png'}}" style="{{$style['project-links-img']}}" />
                                                </td>
                                                <td style="{{$style['project-links-td']}}">
                                                    &nbsp;<a style="{{$style['website-url']}}" href="{{config('app.website_url')}}" target="_blank">{{config('app.website_url')}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="{{$style['project-links-td']}}">
                                                    <img class="mail" src="{{config('app.url') . config('app.images_storage') . 'ico-mail.png'}}" style="{{$style['project-links-img']}}" />
                                                </td>
                                                <td style="{{$style['project-links-td']}}">
                                                    &nbsp;<a style="{{$style['support-email']}}" href="mailto:{{config('app.support_email')}}">{{config('app.support_email')}}</a>
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
                                    <td style="{{$style['content-td']}}">
                                        @yield('content')
                                    </td>
                                </tr>
                                <tr>
                                    <td style="{{$style['footer-regards']}}">
                                        С уважением,<br/>
                                        команда {{config('app.name')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="{{$style['footer-hr-td']}}">
                                        <hr style="{{$style['footer-hr']}}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="{{$style['footer-unsubscribe-td']}}">
                                        Вы можете отписаться от рассылки по <a href="{{config('app.url') . '/information.php'}}" style="{{$style['footer-unsubscribe-a']}}">ссылке</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                        </td>
                    </tr>
                </table>
                <![endif]-->
            </div>
        </center>
    </body>
</html>
