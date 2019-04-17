<!DOCTYPE html5>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="/{{getenv('APP_NAME')}}/public/assets/images/favicon.ico">

        <title>SRMAB-Donor Management Portal</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="/{{getenv('APP_NAME')}}/plugins/morris/morris.css">

        <!-- Plugins css-->
        <link href="/{{getenv('APP_NAME')}}/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="/{{getenv('APP_NAME')}}/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="/{{getenv('APP_NAME')}}/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- App css -->
        <link href="/{{getenv('APP_NAME')}}//public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/public/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/public/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/public/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/public/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/public/assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="/{{getenv('APP_NAME')}}/public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/{{getenv('APP_NAME')}}/plugins/switchery/switchery.min.css">

        <link href="/{{getenv('APP_NAME')}}/public/assets/css/app.css" rel="stylesheet" type="text/css" />
       <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                           
                            <!-- End mobile menu toggle-->
                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                            <!--Zircos-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <div class="btn-group" role="group" style="padding-left: 0px;">
                         <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>SRMAB
                        <a href="index.html" class="logo">
                           <img src="/{{getenv('APP_NAME')}}/public/assets/images/logo.png" id="logoimg" alt="" height="50">
                           
                        </a>
                        </div>


                    </div>
                    <!-- End Logo container-->


                        </div>
                    </div>
                    <!-- end menu-extras -->

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

        </header>
        <!-- End Navigation Bar-->
<div class="wrapper">

    <div class="container">
    <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title"></h4>
                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>




                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                © 2017. All rights reserved.
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
        </div>
        <!-- jQuery  -->
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/jquery.min.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/bootstrap.min.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/detect.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/fastclick.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/jquery.blockUI.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/waves.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/jquery.slimscroll.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/jquery.scrollTo.min.js"></script>
        <script src="/{{getenv('APP_NAME')}}/plugins/switchery/switchery.min.js"></script>

        <script src="/{{getenv('APP_NAME')}}/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="/{{getenv('APP_NAME')}}/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="/{{getenv('APP_NAME')}}/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="/{{getenv('APP_NAME')}}/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="/{{getenv('APP_NAME')}}/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="/{{getenv('APP_NAME')}}/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/public/assets/pages/jquery.autocomplete.init.js"></script>

        <script type="text/javascript" src="/{{getenv('APP_NAME')}}/public/assets/pages/jquery.form-advanced.init.js"></script>

        <!-- App js -->
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/jquery.core.js"></script>
        <script src="/{{getenv('APP_NAME')}}/public/assets/js/jquery.app.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" type="text/javascript"></script>

    </body>
</html>