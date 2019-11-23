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

            .message .user-name {
                color: #333;
                font-size: 26px;
                line-height: 1.8em;
            }

            .message .user-name strong {
                font-style: italic;
            }

            .message .token {
                color: #000000;
                text-align: center;
                padding: 40px;
            }

            .message .token span {
                background-color: #e74726;
                color: #fff;
                font-weight: 600;
                font-size: 22px;
                padding: 15px 25px;
                border-radius: 5px;
            }

            .message .msg-footer-text {
                font-size: 13px;
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
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="header-logo">
                            <a href="{{ url('/') }}" target="_blank">
                                <img src="{{ url('assets/images/logo.png') }}" title="{{ $app_name }}" alt="{{ $app_name }}">
                            </a>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="message">
                            <p class="user-name">Hello <strong> {{ $name }},</strong></p>

                            <p class="msg-header-text">
                                You are receiving this email because we received a password reset request for your <strong>{{ $app_name }}</strong> account.
                                <br>
                                To change the password verify your email with the CODE given below.
                            </p>

                            <p class="token">
                                <span>{{ $token }}</span>
                            </p>

                            <p class="msg-footer-text">
                                If you did not request a password reset, no further action is required.
                            </p>

                            <p class="message-regards">
                                Regards, <br>
                                <span>{{ $app_name }} Customer Support</span>
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