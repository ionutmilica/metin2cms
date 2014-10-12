<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Hello {{ $username }},</h3>
<div>
    You've asked to generate a new password. The new password will be: <b>{{ $password }}</b><br/>
    To proceed confirming the new password click the link bellow:<br/>
    <a href="{{ route('account.password-reset.confirm', array($username, $token)) }}">
        {{ route('account.password-reset.confirm', array($username, $token)) }}
    </a> <br/><br/>
    Note: if you haven't asked for a new password, please ignore this mail.
</div>
</body>
</html>
