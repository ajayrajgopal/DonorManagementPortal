<!DOCTYPE html5>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="/donorportal/public/assets/images/favicon.ico">

        <title>SRMAB-Donor Management Portal</title>
        
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="/donorportal/plugins/morris/morris.css">
                

        <!-- Plugins css-->
        <link href="/donorportal/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="/donorportal/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="/donorportal/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="/donorportal/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

        <!-- App css -->
        <link href="/donorportal/public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/donorportal/plugins/switchery/switchery.min.css">

        <link href="/donorportal/public/assets/css/app.css" rel="stylesheet" type="text/css" />
        <link href="/donorportal/public/assets/css/fullcalendar.min.css" rel='stylesheet' />
        <link href="/donorportal/public/assets/css/fullcalendar.print.min.css" rel='stylesheet' media='print' />
        <script src="/donorportal/public/assets/js/lib/moment.min.js"></script>
        <script src="/donorportal/public/assets/js/lib/jquery.min.js"></script>
        <script src="/donorportal/public/assets/js/fullcalendar.min.js"></script>

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="/donorportal/public/assets/js/modernizr.min.js"></script>
        <script src="/donorportal/public/assets/js/jquery.min.js"></script>
        
        
        <script>

        </script>
    </head>


    <body>

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
                           <img src="/public/assets/images/logo.png" id="logoimg" alt="" height="50">
                           
                        </a>
                        </div>


                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                          
                             <div class="logout">
                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="logout">
                                            <i class="ti-power-off m-r-5"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                </form>

                            </div>
                        </ul>
                    </div>
                        </div>
                    </div>
                    <!-- end menu-extras -->

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="\{{ getenv('APP_NAME') }}\public\index"><i class="fa fa-home"></i>Home</a>
                            </li>
                            @if(Session::get('reportsaccess')=='Y')
                            <li class="has-submenu">
                                <a href="\{{ getenv('APP_NAME') }}\public\reports"><i class="fa fa-book"></i>Reports</a>
                            </li>
                            @endif
                            @if(Session::get('adduser')=='Y')

                            <li class="has-submenu">
                                <a href="\{{ getenv('APP_NAME') }}\public\register"><i class="fa fa-plus"></i>Add User</a>
                            </li>
                            @endif

                        </ul>
                        <!-- End navigation menu -->

                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">


                
                <!-- end page title end breadcrumb -->
                @yield('content')


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
        <!-- /<script src="/public/assets/js/jquery.min.js"></script> -->
        <script src="/donorportal/public/assets/js/bootstrap.min.js"></script>
        <script src="/donorportal/public/assets/js/detect.js"></script>
        <script src="/donorportal/public/assets/js/fastclick.js"></script>
        <script src="/donorportal/public/assets/js/jquery.blockUI.js"></script>
        <script src="/donorportal/public/assets/js/waves.js"></script>
        <script src="/donorportal/public/assets/js/jquery.slimscroll.js"></script>
        <script src="/donorportal/public/assets/js/jquery.scrollTo.min.js"></script>
        <script src="/donorportal/plugins/switchery/switchery.min.js"></script>

        <script src="/donorportal/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="/donorportal/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="/donorportal/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="/donorportal/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="/donorportal/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="/donorportal/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="/donorportal/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="/donorportal/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="/donorportal/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="/donorportal/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="/donorportal/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="/donorportal/public/assets/pages/jquery.autocomplete.init.js"></script>

        <script type="text/javascript" src="/donorportal/public/assets/pages/jquery.form-advanced.init.js"></script>

        <!-- App js -->
        <script src="/donorportal/public/assets/js/jquery.core.js"></script>
        <script src="/donorportal/public/assets/js/jquery.app.js"></script>


    </body>

</html>