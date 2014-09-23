<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>
         @section('title')
            Metin2CMS
         @show
        </title>
        <meta name="generator" content="Bootply"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @section('style')
            <!--
            <link href="http://bootswatch.com/flatly/bootstrap.min.css" rel="stylesheet">
            -->
            <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
            <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
  <div class="navbar-header">
    <a class="navbar-brand" rel="home" href="{{ route('home') }}">Metin2CMS</a>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="/home">Download</a></li>
    </ul>
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
          Galerie </a>
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
        @yield('content')
      </div>
  </div>
  <!--/center-->
  <!--right-->
  <div class="col-sm-3">
    <div class="row">
        @section('rigt')
      <div class="col-xs-12">
          <!-- Login module -->
        <div class="panel panel-default">
          <div class="panel-heading">
            Logare
          </div>
          <div class="panel-body">
            <form class="form-signin" role="form" action="{{ route('account.login') }}" method="post">
              <div class="form-group">
                <input type="username" name="username" class="form-control" placeholder="Username" required autofocus>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
              </div>
            </form>
             {{ link_to_route('account.recover', 'Forgot password?') }}
          </div>
        </div>
        <hr>
          <!-- End login module -->

          <!-- Download module -->
        <div class="panel panel-default">
          <div class="panel-heading">
            Download
          </div>
          <div class="panel-body">
            <div class="span7 text-center">
              <a class="btn btn-primary btn-lg" role="button">&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-download-alt"></span>&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        $('#highscore a:first').tab('show');
    });
</script>
@show
</body>
</html>