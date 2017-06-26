<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="../themes/default.css">
</head>
<body>
<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }

    body, body *:not(html):not(style):not(br):not(tr):not(code) {
        font-family: Avenir, Helvetica, sans-serif;
        box-sizing: border-box;
    }

    body {
        background-color: #f5f8fa;
        color: #74787E;
        height: 100%;
        hyphens: auto;
        line-height: 1.4;
        margin: 0 auto;
        padding: 0;
        -moz-hyphens: auto;
        -ms-word-break: break-all;
        width: 100% !important;
        -webkit-hyphens: auto;
        -webkit-text-size-adjust: none;
        word-break: break-all;
        word-break: break-word;
    }

    p,
    ul,
    ol,
    blockquote {
        line-height: 1.4;
        text-align: left;
    }

    a {
        color: #3869D4;
    }

    a img {
        border: none;
    }

    /* Typography */

    h1 {
        color: #2F3133;
        font-size: 19px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
    }

    h2 {
        color: #2F3133;
        font-size: 16px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
    }

    h3 {
        color: #2F3133;
        font-size: 14px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
    }

    p {
        color: #74787E;
        font-size: 16px;
        line-height: 1.5em;
        margin-top: 0;
        text-align: left;
    }

    p.sub {
        font-size: 12px;
    }

    img {
        max-width: 100%;
    }

    /* Layout */

    .wrapper {
        background-color: #f5f8fa;
        margin: 0 auto;
        padding: 0;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .content {
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    /* Header */

    .header {
        text-align: center;
        background: #000;
    }

    .header a {
        color: #bbbfc3;
        text-decoration: none;
    }

    .header-menu {
    }

    .header-menu a {
        padding: 3px 8px;
        color: #fff;
    }

    /* Body */

    .body {
        background-color: #FFFFFF;
        border-bottom: 1px solid #EDEFF2;
        border-top: 1px solid #EDEFF2;
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .inner-body {
        background-color: #FFFFFF;
        margin: 0 auto;
        padding: 0;
        width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 570px;
    }


    /* Footer */

    .footer {
        margin: 0 auto;
        padding: 0;
        text-align: center;
        width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 570px;
        background: #333333;
    }

    .footer p {
        color: #fff;
        font-size: 12px;
    }

    .logo-footer {
        padding: 3px;
        background: #ffca13;
    }

    .footer_info {

    }
    .footer_info p {
        text-align: right;
        font-size: 14px;
        color: #fff;
    }

    .footer_bottom {
        color: #fff;
        font-size: 12px;
        text-align: right;
    }

    /* Tables */

    .table table {
        margin: 30px auto;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .table th {
        border-bottom: 1px solid #EDEFF2;
        padding-bottom: 8px;
    }

    .table td {
        color: #74787E;
        font-size: 15px;
        line-height: 18px;
        padding: 10px 0;
    }

    .content-cell {
        padding: 35px;
    }

    /* Buttons */

    .action {
        margin: 30px auto;
        padding: 0;
        text-align: center;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .button {
        border-radius: 3px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
        color: #FFF;
        display: inline-block;
        text-decoration: none;
        -webkit-text-size-adjust: none;
    }

    .button-blue {
        background-color: #3097D1;
        border-top: 10px solid #3097D1;
        border-right: 18px solid #3097D1;
        border-bottom: 10px solid #3097D1;
        border-left: 18px solid #3097D1;
    }

    .button-green {
        background-color: #2ab27b;
        border-top: 10px solid #2ab27b;
        border-right: 18px solid #2ab27b;
        border-bottom: 10px solid #2ab27b;
        border-left: 18px solid #2ab27b;
    }

    .button-red {
        background-color: #bf5329;
        border-top: 10px solid #bf5329;
        border-right: 18px solid #bf5329;
        border-bottom: 10px solid #bf5329;
        border-left: 18px solid #bf5329;
    }


</style>
<table width="100%" cellpadding="0" cellspacing="0" style="text-align: center">
    <tr>
        <td>
            <table class="wrapper" width="670" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table class="content" width="100%" cellpadding="0" cellspacing="0">
                        <!-- Header -->
                            <tr>
                                <td class="header" width="100%" cellpadding="0" cellspacing="0">

                                    @include('site.emails.includes.header')

                                </td>
                            </tr>

                        <!-- Email Body -->
                            <tr>
                                <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                    <table class="" align="center" width="100%" cellpadding="0" cellspacing="0">
                                        <!-- Body content -->
                                        <tr>
                                            <td class="content-cell">

                                                @yield('content')

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!-- Footer -->
                            <tr>
                                <td class="footer" width="100%" cellpadding="0" cellspacing="0">

                                    @include('site.emails.includes.footer')

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
