<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{config('app.name')}}</title>

    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
    </style>

    <style type="text/css">
        .name {
            font-size: 16px;
            padding-top: 40px;
        }

        .support {
            font-size: 12px;
            margin-top: 25px;
        }
    </style>

    <style type="text/css" media="screen">
        @media screen {
            /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
            td, h1, h2, h3 {
                font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 480px)">
        /* Mobile styles */
        @media only screen and (max-width: 480px) {
            img.logo {
                width: 43px;
                height: 39px
            }

            .name {
                font-size: 10px !important;
                padding-top: 15px;
            }

            .support {
                font-size: 10px;
                margin-top: 15px;
            }

            table[class="w320"] {
                width: 320px !important;
            }
        }
    </style>
</head>
<body class="body">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
    <tr>
        <td align="center" valign="top" width="100%">
            <center>
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
                    <tr>
                        <td align="center" valign="top">
                            <table style="background: url('{{config('app.url') . '/img/static/header-bg.jpg'}}') 100% 100% no-repeat; margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="text-align:left; width: 50px">
                                        <img class="logo" style="padding: 20px 0px 15px 10px;" src="{{config('app.url') . '/img/static/logo.png'}}" />
                                    </td>
                                    <td class="name" style="color: white;">
                                        {{config('app.name')}}
                                    </td>

                                    <td class="support" style="color: white; float: right; margin-right: 5px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <img src="{{config('app.url') . '/img/static/ico-site.png'}}" style="float: right"/>
                                                </td>
                                                <td>
                                                    <a style="color: white;" href="{{config('app.websiteUrl')}}" target="_blank">{{config('app.websiteUrl')}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="{{config('app.url') . '/img/static/ico-mail.png'}}" style="float: right"/>
                                                </td>
                                                <td>
                                                    <a style="color: white;" href="mailto:{{config('app.supportEmail')}}">{{config('app.supportEmail')}}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
