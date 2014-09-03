{{ var_dump(Session::get('errors')) }}
<form action="{{ route('account.create') }}" method="POST">
    Username: <input type="text" name="username"><br/>
    Password: <input type="password" name="password"><br/>
    Repeat password: <input type="password" name="password_confirmation"><br/>
    Email: <input type="text" name="email"><br/>
    <input type="submit" name="submit" value="Create">
</form>