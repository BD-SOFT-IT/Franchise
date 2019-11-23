<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Lato:400,700|Open+Sans:400,700&display=swap');
        body {
            background-color: #e4e4e4c7 !important;
            font-family: 'Lato', sans-serif;
            color: #6d6d6d;
            padding: 30px 50px;
            margin: 0;
        }
        table {
            width: 100%;
            background-color: #fff;
            margin: 0 auto;
            padding: 50px;
        }

        .header-logo {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000000;
        }

        .header-logo img {
            height: 90px;
        }

        .message {
            font-size: 14px;
            letter-spacing: 0.02em;
            line-height: 1.5em;
        }

        .message .msg-header-text {
            padding: 25px 0;
        }

        .information .verify-link {
            background-color: #62b236;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none;
            color: #fff;
        }

        .or {
            display: block;
            font-size: 30px;
            padding: 50px 0 5px;
            color: #333;
            font-weight: 600;
        }

        .verification-code {
            font-weight: 700;
            margin: 30px 0;
        }

        .verification-code strong {
            border: 1px solid #adadad;
            background-color: #e9e9e9;
            padding: 4px 12px;
            color: #e74726;
            letter-spacing: 0.06em;
        }

        .not-u {
            margin: 10px 0 5px;
            font-size: 13px;
        }

        .not-u a {
            color: #62b236;
            text-align: justify;
        }

        .msg-footer-text {
            font-size: 13px;
            text-align: center;
            margin: 0;
        }

        .message-regards {
            line-height: 1.8em;
            margin: 10px 0 0;
            border-top: 1px solid #e74726b3;
            padding-top: 10px;
        }

        .message-regards span {
            color: #e74726;
            font-weight: 600;
        }
        @media only screen and (min-width: 1300px) {
            table {
                width: 1250px !important;
                margin: auto !important;
            }
        }
        @media only screen and (max-width: 992px) {
            body {
                padding: 10px 0 !important;
            }
            table {
                width: 90% !important;
                max-width: 90% !important;
                margin: 0 5% !important;
                padding: 50px 5% !important;
            }
            .inner-section {
                height: 300px !important;
                display: block !important;
            }
            .inner-img {
                display: none !important;
            }
            .message {
                width: 100% !important;
                -ms-flex: 0 0 100% !important;
                -webkit-box-flex: 0 !important;
                flex: 0 0 100% !important;
                margin: 20px 0 !important;
                display: block !important;
            }
        }

    </style>
</head>

<body style="background-color: #e4e4e4c7 !important; font-family: 'Lato', 'Open Sans', sans-serif; color: #6d6d6d; padding: 30px 50px; margin: 0;">

@php($title = getSiteBasic('site_title'))
@php($img = getSiteBasic('site_logo'))
@php($support = getSiteBasic('site_email', 'support@bdsoftit.com'))
@php($mobile = getSiteBasic('site_mobile', '+8801400883400'))

<table  width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; box-sizing: border-box; background-color: #fff; margin: 0 auto; padding: 50px; ">
    <tbody>
    <tr>
        <td>
            <div class="header-logo">
                <a href="{{ url('/') }}" target="_blank">
                    @if($img && strlen($img) > 10)
                        <img src="{{ imageCache($img) }}" alt="{{ $title }}" data-auto-embed="attachment">
                    @else
                        <h3>{{ $title }}</h3>
                    @endif

                </a>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div style="width: 100%;text-align: center;">
                <h2 style="letter-spacing: 0.02em;font-size: 40px; margin: 0 0 5px;">WELCOME</h2>
                <p style="margin: 0 0 15px; color: #000; font-size: 22px; letter-spacing: 0.06em;">Your Franchise/Affiliate account has been activated.</p>
            </div>

            <div class="inner-section" style=" padding: 20px 0 0;display: -ms-flexbox;display: -webkit-box;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap; width: 100%; text-align: center;background-color: #d6d6d6;">
                <div style="width: 40%;-ms-flex: 0 0 40%;-webkit-box-flex: 0;flex: 0 0 40%;" class="inner-img">
                    <img src="{{ asset('images/mailbg-1.png') }}" alt="" data-auto-embed="attachment"/>
                </div>

                <div class="message" style="width: 60%;-ms-flex: 0 0 60%;-webkit-box-flex: 0;flex: 0 0 60%;">

                    <div style="padding: 0 25px;">
                        <div class="msg-header-text">
                            <h2 style="text-align: center;">Thank you for joining with our Affiliate network.</h2>
                            <p style="text-align: center">
                                Click below to start now....
                            </p>
                        </div>

                        <div class="information" style="text-align: center;">
                            <a href="{{ route('admin.login') }}" class="verify-link" target="_blank">
                                Login Affiliate
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div class="">
                <p class="not-u">
                    <span>
                        If The above link is not working copy this link & paste it in Browser: <a href="{{ route('admin.login') }}">{{ route('admin.login') }}</a>
                    </span>
                    <br>
                    <br>
                    <br>

                    You are receiving this email because someone wanted to create an affiliate account
                    <a href="{{ route('index') }}" target="_blank"><strong>{{ $title }}</strong></a>
                    with <a href="mailto:{{ $email }}">{{ $email }}</a>.
                    <br>
                    <small>If this is not you then just ignore this E-mail.</small>
                </p>

                <p class="msg-footer-text">

                </p>

                <p class="message-regards">
                    Regards, <br>
                    <span>{{ $app_name }} Team</span>
                    <br>
                    <small>Email:
                        <a href="mailto:{{ $support }}" target="_top">
                            {{ $support }}
                        </a>
                        <br>
                        Mobile:
                        <a href="tel:{{ $mobile }}" target="_top">
                            {{ mobileNumber($mobile) }}
                        </a>
                    </small>
                </p>
            </div>
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
