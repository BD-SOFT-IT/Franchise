<!DOCTYPE html>
<html>
<head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800);
        body {
            background-color: #e4e4e4c7 !important;
            font-family: 'Open Sans', sans-serif;
            color: #6d6d6d;
            padding: 30px 50px;
            margin: 0;
        }
        table {
            width: 850px;
            background-color: #fff;
            margin: 0 auto;
            padding: 50px;
        }

        .header-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-logo img {
            width: 250px;
        }

        .message {
            padding: 0 70px 20px;
            font-size: 14px;
            letter-spacing: 0.02em;
            line-height: 1.5em;
        }

        .message .msg-header-text {
            padding: 25px 0;
        }

        .msg-short-desc {
            padding-bottom: 25px;
            text-align: justify;
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
            margin: 70px 0 5px;
            font-size: 13px;
        }

        .not-u a, .msg-short-desc a {
            color: #62b236;
            text-align: justify;
        }

        .message .message-regards {
            line-height: 1.8em;
            margin: 10px 0 0;
            border-top: 1px solid #e74726b3;
            padding-top: 10px;
        }

        .message .message-regards span {
            color: #e74726;
            font-weight: 600;
        }

        @media screen and (max-width: 992px) {
            body {
                padding: 50px 0;
            }
            table {
                width: 86%;
                margin: 0 6%;
            }
        }
    </style>
</head>

<body style="background-color: #e4e4e4c7 !important; font-family: 'Open Sans', sans-serif; color: #6d6d6d; padding: 30px 50px; margin: 0;">
<table style="width: 850px; background-color: #fff; margin: 0 auto; padding: 50px;">
    <tbody>
    <tr>
        <td>
            <div class="header-logo">
                <a href="{{ route('index') }}" target="_blank">
                    <picture>
                        <source srcset="{{ asset('assets/images/logo.png') }}" type="image/png">
                        <img src="{{ asset('assets/images/logo.webp') }}">
                    </picture>
                </a>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div class="message">

                <div class="msg-header-text">
                    <h2>Hello{{ ($name) ? ' ' . $name : '' }},</h2>
                </div>

                <p class="msg-short-desc">
                    You are receiving this email because we received a password reset request for your
                    <a href="https://sohojbazaar.com" target="_blank"><strong>SohojBazaar</strong></a> account.
                    <br><br>
                    Please verify your Email to reset the password.
                </p>

                <div class="information">
                    <a href="{{ $url }}" class="verify-link" target="_blank">
                        Click Here To Verify
                    </a>
                    <span class="or">OR</span>
                    <p class="verification-code">
                        Use this verification Code: <strong>{{ $code }}</strong>
                    </p>
                    <p class="not-u">
                        If you did't request a password reset, no further action is required.
                    </p>
                </div>

                <p class="message-regards">
                    Regards, <br>
                    <span>{{ $app_name }} Team</span>
                    <br>
                    <small>Contact:</small>
                    <a href="mailto:support@sohojbazaar.com" target="_top">
                        <small> support@sohojbazaar.com</small>
                    </a>
                </p>
            </div>
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
