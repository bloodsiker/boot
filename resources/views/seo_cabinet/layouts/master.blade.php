<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Seo cabinet</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/iCheck/flat/blue.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::to('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('admin/dist/css/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('seo.cabinet.dashboard') }}" class="logo">
            <span class="logo-mini">SEO</span>
            <span class="logo-lg">SEO</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since {{ $created_at }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('crm.logout') }}">Выход <i class="fa fa-sign-out"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        @include('seo_cabinet.includes.sidebar')

    </aside>

    <div class="content-wrapper">

        @yield('content')

    </div>

    <footer class="main-footer hidden">

    </footer>


</div>

<script src="{{ URL::to('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::to('admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::to('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::to('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::to('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ URL::to('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('admin/dist/js/app.min.js') }}"></script>

<script>
    var token = '{{ Session::token() }}';
    var urlRequestInfo = '{{ route('crm.request.info') }}';
    var urlRequestEdit = '{{ route('crm.request.edit') }}';
</script>
<script>
    $(function () {
        $('#table1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "filter": true,
            "sort": true,
            "order": [[ 0, "desc" ]]
        });
    });
</script>
</body>
</html>
