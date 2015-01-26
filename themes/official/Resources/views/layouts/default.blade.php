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
            <link href="{{ assetTheme('css/bootstrap.min.css') }}" rel="stylesheet">

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
        <div class="col-xs-12">
     @section('left')
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
     @show
        </div>
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
        <div class="col-xs-12">
        @section('rigt')
          @include('standard::widgets.login')
          @include('standard::widgets.download')
          @include('standard::widgets.highscore')
        @show
        </div>
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