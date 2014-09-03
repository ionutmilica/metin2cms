
<form action="{{ route('account.auth') }}" method="POST">
    Username: <input type="text" name="username"><br/>
    Password: <input type="password" name="password"><br/>
    <input type="submit" name="submit" value="Login">
</form>