@if ( ! Auth::check())
<div class="panel panel-default">
    <div class="panel-heading">
        Logare
    </div>
    <div class="panel-body">
        <form class="form-signin" role="form" action="{{ route('account.login') }}" method="post">
            {!! Form::token() !!}
            <div class="form-group">
                <input type="username" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </div>
        </form>
        {!! link_to_route('account.password-reset', 'Forgot password?') !!}
    </div>
</div>
<hr>
@endif