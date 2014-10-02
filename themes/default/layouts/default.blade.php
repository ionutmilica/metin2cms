<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>
         @section('title')
            Metin2CMS
         @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @section('style')
            <!--
            <link href="http://bootswatch.com/flatly/bootstrap.min.css" rel="stylesheet">
            -->
            <link href="{{ assetTheme('css/bootstrap.min.css') }}" rel="stylesheet">
            <link href="{{ assetTheme('css/todc-bootstrap.min.css') }}" rel="stylesheet">

            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            <style type="text/css">
                body {
                    padding-top: 70px;
                }
                .wrapper {
                    margin-left:0;
                    margin-right:0;
                }
            </style>
        @show
</head>
<body>

<!-- Start navigation -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" rel="home" href="{{ route('home') }}">Metin2CMS</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="{{ route('home') }}">Home</a></li>
              <li><a href="{{ route('download') }}">Download</a></li>
            </ul>
            @if (Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('account.logout') }}">Logout</a>
                </li>
            </ul>
            @endif
        </div>
    </div>
</div>
<!-- End navigation -->

<div class="wrapper">
  <!--left-->
  <div class="col-sm-3">
    <div class="row">
     @section('left')
      <div class="col-xs-12">
        <div class="list-group">
          <a class="list-group-item active">
          News </a>
          <a href="#" class="list-group-item">Latest news</a>
          <a href="#" class="list-group-item">Archive</a>
        </div>
        <hr>
        <div class="list-group">
          <a class="list-group-item active">
          Gallery </a>
          <a href="#" class="list-group-item">Screenshots</a>
          <a href="#" class="list-group-item">Wallpapers</a>
        </div>
        <hr>
        <div class="list-group">
          <a class="list-group-item active">First steps </a>
          <a href="#" class="list-group-item">First steps</a>
          <a href="#" class="list-group-item">Tutorials</a>
        </div>
        <hr>
      </div>
     @show
    </div>
  </div>
  <!--/left-->

  <!--center-->
  <div class="col-sm-6">
      <div class="row">
          @if ( ! Auth::check())
          <div class="jumbotron">
              <div class="span7 text-center">
                  <a href="{{ route('account.register') }}" class="btn btn-primary btn-lg" role="button">Create an account</a>
              </div>
          </div>
          @else
          <div class="jumbotron">
              <div class="span7 text-center">
                  <a href="{{ route('account.index') }}" class="btn btn-primary btn-lg" role="button">Account info</a>
                  <a href="#" class="btn btn-primary btn-lg" role="button">Item mall</a>
                  <a href="{{ route('account.logout') }}" class="btn btn-primary btn-lg" role="button">Logout</a>
              </div>
          </div>
          @endif
          <hr>
        @yield('content')
      </div>
  </div>
  <!--/center-->
  <!--right-->
  <div class="col-sm-3">
    <div class="row">
        @section('rigt')
      <div class="col-xs-12">
          @if ( ! Auth::check())
          <!-- Login module -->
        <div class="panel panel-default">
          <div class="panel-heading">
            Logare
          </div>
          <div class="panel-body">
            <form class="form-signin" role="form" action="{{ route('account.login') }}" method="post">
              {{ Form::token() }}
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
             {{ link_to_route('account.password-reset', 'Forgot password?') }}
          </div>
        </div>
        <hr>
          <!-- End login module -->
        @endif
          <!-- Download module -->
        <div class="panel panel-default">
          <div class="panel-heading">
            Download
          </div>
          <div class="panel-body">
            <div class="span7 text-center">
              <a class="btn btn-primary btn-lg" role="button" href="{{ route('download') }}">
                  &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-download-alt"></span>&nbsp;&nbsp;&nbsp;&nbsp;
              </a>
            </div>
          </div>
        </div>
        <hr>
        <!-- End download module -->

        <!-- Highscore module -->
            @include('layouts.partials.highscore')
            <hr>
        <!-- End highscore module -->
      </div>
        @show
    </div>
  </div>
  <!--/right-->
  <hr>
</div>
<!-- /.container -->
@section('js')
<script type='text/javascript' src="{{ assetTheme('js/jquery.min.js') }}"></script>
<script type='text/javascript' src="{{ assetTheme('js/bootstrap.min.js') }}"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        $('#highscore a:first').tab('show');
    });
</script>
@show
</body>
</html>