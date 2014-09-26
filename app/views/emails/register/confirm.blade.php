<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Welcome {{ $login }}</h2>
<div>
    Before you can user you account, you should activate it. Click the link below:<br />
    {{ URL::to('account.register.confirm', array($login, $confirmation_token)) }}.
</div>
</body>
</html>
