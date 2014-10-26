<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Metin2CMS</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="{{ assetTheme('css/datepicker/datepicker3.css', 'admin') }}" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{ assetTheme('css/daterangepicker/daterangepicker-bs3.css', 'admin') }}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ assetTheme('css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', 'admin') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ assetTheme('css/AdminLTE.css', 'admin') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Metin2CMS
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ Auth::user()->login }} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{ assetTheme('img/avatar2.png','admin') }}" class="img-circle" alt="User Image" />
                                    <p>{{ Auth::user()->login }} - Admin</p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ 'admin/logout' }}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Home</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <!-- Sparkline -->
        <script src="{{ assetTheme('js/plugins/sparkline/jquery.sparkline.min.js', 'admin') }}" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{ assetTheme('js/plugins/daterangepicker/daterangepicker.js', 'admin') }}" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="{{ assetTheme('js/plugins/datepicker/bootstrap-datepicker.js', 'admin') }}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ assetTheme('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', 'admin') }}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ assetTheme('js/plugins/iCheck/icheck.min.js', 'admin') }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{ assetTheme('js/AdminLTE/app.js', 'admin') }}" type="text/javascript"></script>
    </body>
</html>