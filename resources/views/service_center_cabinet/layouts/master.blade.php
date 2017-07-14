<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <meta name="_token"  content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ URL::to('admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::to('admin/dist/css/skins/_all-skins.min.css') }}">
    {{--<link rel="stylesheet" href="{{ URL::to('admin/dist/css/skins/skin-black.css') }}">--}}


    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/vendor/angular/angular-csp.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin.css') }}">


    <style>
        .drop-street .dropdown-menu {
            max-height: 200px;
            overflow: auto;
            width: 100%;
        }
    </style>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->
</head>
<body class="hold-transition skin-black sidebar-mini" ng-app="App" ng-cloak>
<div class="wrapper" ng-controller="AdminController">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('admin.cabinet') }}" class="logo">
            <span class="logo-mini">Adm</span>
            <span class="logo-lg">Admin</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <a href="{{ route('cabinet.messages') }}">
                Посмотреть на сайте
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li>
                        <a href="{{ route('cabinet.messages') }}">
                            <i class="fa fa-envelope-o"></i>
                            {{--<span class="label label-success">4</span>--}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('main') }}">На сайт <i class="fa fa-sign-out"></i></a>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="height: 80px">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Зарегистрирован </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('cabinet.settings') }}" class="btn btn-default btn-flat">Профиль</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('cabinet.logout') }}" class="btn btn-default btn-flat">Выход</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        @include('service_center_cabinet.includes.sidebar')

    </aside>

    <div class="content-wrapper">

        @yield('content')

    </div>

    <footer class="main-footer hidden">

    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ URL::to('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::to('admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::to('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::to('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<!-- Slimscroll -->
<script src="{{ URL::to('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('admin/dist/js/app.min.js') }}"></script>



<script src="{{ asset('site/vendor/angular/angular.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.6.4/angular-locale_ru-ru.min.js"></script>
<script src="{{ asset('site/vendor/angular-animate/angular-animate.js') }}"></script>
<script src="{{ asset('site/vendor/angular-aria/angular-aria.js') }}"></script>
<script src="{{ asset('site/vendor/angular-messages/angular-messages.js') }}"></script>


<script src="{{ asset('site/vendor/angular-bootstrap/ui-bootstrap-tpls.min.js') }}"></script>

<script src="{{ asset('site/vendor/angular-base64-upload/dist/angular-base64-upload.js') }}"></script>
<script src="{{ asset('site/vendor/angular-upload/angular-upload.min.js') }}"></script>

<!--==============================MAP=====================-->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDdycmfIt4XbYlFLw5138RsuKNLb_yUFA4&language=RU"></script>
<script src="{{ asset('site/vendor/ngmap/build/scripts/ng-map.min.js') }}"></script>


<script src="{{ asset('site/vendor/underscore/underscore.js') }}"></script>
<script src="{{ asset('site/vendor/angular-underscore-module/angular-underscore-module.js') }}"></script>

<script src="{{ asset('site/vendor/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('site/vendor/angular-chart.js/dist/angular-chart.js') }}"></script>


<!--==============RATING STAR=========================-->
<script src="{{ asset('site/vendor/angular-rating/src/angular-rating.js') }}"></script>

<!--==============APP=========================-->
<script src="{{ asset('site/js/admin.js') }}"></script>
<script src="{{ asset('site/js/model/model.js') }}"></script>
<script src="{{ asset('site/js/controllers/AdminDashboardCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/AdminCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/AddScCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/RefactorScCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/SettingsScController.js') }}"></script>
<script src="{{ asset('site/js/controllers/MessagesCtrl.js') }}"></script>

<script src="{{ URL::to('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
    $(function () {
        $(".aboutSc").wysihtml5();
    });
</script>

</body>
</html>
