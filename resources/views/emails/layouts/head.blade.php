<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {border-collapse: collapse;}
    </style>
    <![endif]-->

    <style type="text/css">
        /* Basics */
        body {
            Margin: 0;
            padding: 0;
            min-width: 100%;
            background-color: #ffffff;
            font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
        table {
            border-spacing: 0;
            font-family: sans-serif;
            color: #333333;
        }
        td {
            padding: 0;
        }
        img {
            border: 0;
        }
        img.website, img.mail {
            float: right;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        .webkit {
            max-width: 600px;
        }
        .outer {
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
        }
        .head-background-image {
            background: url('http://cabinet.vlevels.ru/img/static/header-bg.jpg') 100% 100%;
        }
        .full-width-image img {
            width: 100%;
            height: auto;
        }
        .inner {
            padding: 10px;
        }
        p {
            margin: 0;
        }
        a {
            color: #ee6a56;
            text-decoration: underline;
        }
        .h1 {
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 18px;
        }
        .h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        hr {
            border: none;
            color: #b1aeae;
            background-color: #b1aeae;
            height: 1px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .footer {
            font-size: 13px;
        }
        .regards {
            font-size: 13px;
            font-style: italic;
            padding-top: 30px;
        }
        .project-name {
            color: white;
            font-size: 14px;
            padding-top: 25px;
        }
        .project-links {
            font-size: 14px;
            float: right;
            padding-top: 7px;
        }
        .project-links td {
            padding: 3px;
        }
        .project-logo {
            width: 80px;
        }
        .header {
            padding: 15px;
        }

        /* One column layout */
        .one-column .contents {
            text-align: left;
        }
        .one-column p {
            font-size: 14px;
            margin-bottom: 10px;
        }
        /*Two column layout*/
        .two-column {
            text-align: center;
            font-size: 0;
        }
        .two-column .column {
            width: 100%;
            max-width: 300px;
            display: inline-block;
            vertical-align: top;
        }

        /* Windows Phone Viewport Fix */
        @-ms-viewport {
            width: device-width;
        }
    </style>
</head>
<body>
<center class="wrapper">
    <div class="webkit">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center">
            <tr>
                <td>
        <![endif]-->
        <table class="outer" align="center">
            <tr>
                <td class="head-background-image">
                    <table width="100%" class="header">
                        <tr>
                            <td class="project-logo">
                                <img src="{{config('app.url') . '/img/static/logo.png'}}" alt="logo" />
                            </td>
                            <td class="project-name">
                                {{config('app.name')}}
                            </td>
                            <td class="project-links">
                                <table>
                                    <tr>
                                        <td>
                                            <img class="website" src="{{config('app.url') . '/img/static/ico-site.png'}}" />
                                        </td>
                                        <td>
                                            &nbsp;<a style="color: white;" href="{{config('app.websiteUrl')}}" target="_blank">{{config('app.websiteUrl')}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="mail" src="{{config('app.url') . '/img/static/ico-mail.png'}}" />
                                        </td>
                                        <td>
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
                <td class="one-column">
                    <table width="100%">
                        <tr>
                            <td class="inner contents">
