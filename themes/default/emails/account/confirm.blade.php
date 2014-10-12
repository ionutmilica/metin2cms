<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Hello {{ $login }},</h3>
<div>
    Welcome to our game. Before starting to play, please confirm the email. <br/>
    The email helps you to recover the password, safebox password and other things.<br/>
    Confirmation link is: <a href="{{ route('account.register.confirm', array($login, $token)) }}">
        {{ route('account.register.confirm', array($login, $token)) }}
    </a> <br/>
    Note: if you haven't registered at our website, please ignore this mail.
</div>
</body>
</html>
