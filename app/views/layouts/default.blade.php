<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Metin2CMS</title>
<meta name="generator" content="Bootply"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
</head>
<body>

<!-- Start navigation -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" rel="home" href="#">Metin2CMS</a>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="#">Home</a></li>
      <li><a href="#">Download</a></li>
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
        <div class="panel panel-default">
          <div class="panel-heading">
            Logare
          </div>
          <div class="panel-body">
            <form class="form-signin" role="form">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Username" required autofocus>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
              </div>
            </form>
          </div>
        </div>
        <hr>
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
        <div class="panel panel-default">
          <div class="panel-heading">Rank</div>
          <div class="panel-body">
            <div class="bs-example bs-example-tabs">
              <ul id="highscore" class="nav nav-tabs">
                <li class="">
                    <a href="#players" data-toggle="tab">
                        <img src="http://gf2.geo.gfsrv.net/cdna3/232b3d471340f1d6bed8d4deccc169.png" alt="">
                    </a>
                </li>
                <li class="active">
                    <a href="#guilds" data-toggle="tab">
                        <img src="http://gf3.geo.gfsrv.net/cdn21/f46f0d2068aca9e35f0359d1f1b020.png" alt="">
                    </a>
                </li>
              </ul>
              <div id="highscoreContent" class="tab-content">
                <div class="tab-pane fade" id="players">
                  <p>
                    <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                      <td width="5">1</td>
                      <td>Ionut</td>
                      <td width="10">
                        <img src="http://gf1.geo.gfsrv.net/cdn04/aa57fedc2cac81f2ca33a7f3e81353.png" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td width="5">2</td>
                      <td>Gabi</td>
                      <td width="10">
                        <img src="http://gf2.geo.gfsrv.net/cdn1f/ed59c71803b8033c6bc31c7283892a.png" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td width="5">3</td>
                      <td>Mihai</td>
                      <td width="10">
                        <img src="http://gf3.geo.gfsrv.net/cdn5f/c8a3e8bb3e0320c9434f462bfeecdb.png" alt="">
                      </td>
                    </tr>
                    </tbody>
                    </table>
                    <div class="span7 text-center">
                      <a href="#" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                  </p>
                </div>
                <div class="tab-pane fade active in" id="guilds">
                  <p>
                    <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                      <td width="5">1</td>
                      <td>InStyle</td>
                      <td width="10">
                        <img src="http://gf1.geo.gfsrv.net/cdn04/aa57fedc2cac81f2ca33a7f3e81353.png" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td width="5">2</td>
                      <td>7UP</td>
                      <td width="10">
                        <img src="http://gf2.geo.gfsrv.net/cdn1f/ed59c71803b8033c6bc31c7283892a.png" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td width="5">3</td>
                      <td>TheRulers</td>
                      <td width="10">
                        <img src="http://gf3.geo.gfsrv.net/cdn5f/c8a3e8bb3e0320c9434f462bfeecdb.png" alt="">
                      </td>
                    </tr>
                    </tbody>
                    </table>
                    <div class="span7 text-center">
                      <a href="#" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
    </div>
      @show
      </div>
  </div>
  <!--/right-->
  <hr>
</div>
<!-- /.container -->
<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<script type='text/javascript'>
  $(document).ready(function() {
      $('#highscore a:first').tab('show');
  });
</script>
</body>
</html>