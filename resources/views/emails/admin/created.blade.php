<!DOCTYPE html>
<html>
<head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800);
        body {
            width: 100%;
            background-color: #9c9c9c !important;
            font-family: 'Open Sans', sans-serif;
            color: #6d6d6d;
        }
        table {
            width: 750px;
            background-color: #fff;
            margin: 30px auto;
            border-radius: 15px;
            border: 1px solid #e7472654;
        }

        .header-logo {
            text-align: center;
        }

        .header-logo img {
            width: 250px;
            padding: 55px 0 20px;
        }

        .message {
            padding: 0 70px 20px;
            font-size: 14px;
            letter-spacing: 0.02em;
            line-height: 1.5em;
        }

        .message .msg-header-text {
            text-align: center;
            padding: 55px;
        }

        .account-information {
            border: 2px dotted #62b236;
            padding: 55px;
        }

        .message .user-name {
            color: #333;
            font-size: 22px;
            line-height: 1.8em;
        }

        .message .user-name strong {
            font-style: italic;
        }

        .message .msg-footer-text {
            font-size: 13px;
            text-align: center;
            margin: 30px 0;
        }

        .message .msg-footer-text a {
            background-color: #62b236;
            padding: 10px 35px;
            font-size: 16px;
            font-weight: 600;
            text-transform: capitalize;
            text-decoration: none;
            color: #fff;
        }

        .message .message-regards {
            border-top: 1px solid #e7472630;
            padding-top: 10px;
            line-height: 1.8em;
        }

        .message .message-regards span {
            color: #e74726;
            font-weight: 600;
        }

        @media screen and (max-width: 992px) {
            table {
                width: 80%;
                margin: 10%;
            }
        }
    </style>
</head>

<body>
@php($title = getSiteBasic('site_title'))
@php($img = getSiteBasic('site_logo'))
@php($support = getSiteBasic('site_email', 'support@bdsoftit.com'))
@php($mobile = getSiteBasic('site_mobile', '+8801400883400'))
<table>
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
            <div class="message">
                <p class="user-name">Hello <strong> {{ $name }},</strong></p>

                <div class="msg-header-text">
                    <h2>Congratulations...!!!</h2>
                    We just made you <strong>{{ $role }}</strong> for our Online Super Market.
                </div>

                <div class="account-information">
                    <strong>Login Email:</strong> {{ $email }} <br><br>
                    <strong>Login Password:</strong> {{ $password }}
                </div>

                <p class="msg-footer-text">
                    <a href="{{ route('admin.login') }}" target="_blank">
                        Login in to get started
                    </a>
                </p>

                <p class="message-regards">
                    Regards, <br>
                    <span>{{ $app_name }} Web Admin</span>
                    <br>
                    <small>Contact:</small>
                    <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" target="_top">
                        <small> {{ env('MAIL_FROM_ADDRESS') }}</small>
                    </a>
                </p>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div class="footer">
                <div class="col">

                </div>

                <div class="col">

                </div>

                <div class="col">

                </div>
            </div>
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
