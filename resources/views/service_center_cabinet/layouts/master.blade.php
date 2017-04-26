<!DOCTYPE html>
<html lang="en" ng-app="App">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My AngularJS App</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="{{ asset('site/vendor/angular-material/angular-material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body ng-cloak>

<div ng-controller="AdminController" layout-fill layout="column">

    <div class="layout-admin" layout="row" flex>
        <md-sidenav class="md-sidenav-left"
                    md-component-id="side"
                    md-is-locked-open="$mdMedia('gt-md')"
                    md-whiteframe="4">
            <md-toolbar class="md-theme-indigo">
                <h1 class="md-toolbar-tools">Sidenav Left</h1>
            </md-toolbar>
            <md-content>
                @include('service_center_cabinet.includes.sidebar')
            </md-content>
        </md-sidenav>

        <div flex layout="column">
            <md-toolbar layout="row" layout-align="center center">
                @include('service_center_cabinet.includes.header')
            </md-toolbar>
            <md-content flex layout="column">
                @yield('content')
            </md-content>
        </div>

    </div>
</div>


<!--=========================================SCRIPTS========================================-->

<!--==============ANGULAR=========================-->

<script src="{{ asset('site/vendor/angular/angular.js') }}"></script>
<script src="{{ asset('site/vendor/angular-animate/angular-animate.js') }}"></script>
<script src="{{ asset('site/vendor/angular-aria/angular-aria.js') }}"></script>
<script src="{{ asset('site/vendor/angular-messages/angular-messages.js') }}"></script>

<script src="{{ asset('site/vendor/angular-material/angular-material.min.js') }}"></script>
<script src="{{ asset('site/vendor/angular-material/angular-material-mocks.js') }}"></script>


<script src="{{ asset('site/vendor/angular-base64-upload/dist/angular-base64-upload.js') }}"></script>

<!--==============================MAP=====================-->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDdycmfIt4XbYlFLw5138RsuKNLb_yUFA4&language=RU"></script>
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

</body>
</html>
