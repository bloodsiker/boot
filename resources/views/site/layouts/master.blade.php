<!DOCTYPE html>
<html lang="en" ng-app="App" ng-controller="IndexCtrl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('site/img/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('site/img/favicon.ico') }}" type="image/x-icon"/>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="_token"  content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('site/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/vendor/angular/angular-csp.css') }}">
    <link rel="stylesheet" href="{{ asset('site/vendor/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('site/vendor/slick-carousel/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('site/vendor/angular-multi-slider/multislider.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/app.css') }}">
</head>
<body ng-cloak>
<div ng-controller="@yield('controller')" ng-cloak>

    @include('site.includes.header')

    @yield('content')

    @include('site.includes.footer')

</div>

<!--=========================================SCRIPTS========================================-->
<!-- Start SiteHeart code -->
<script>
    (function(){
        var widget_id = 878216;
        _shcp =[{widget_id : widget_id}];
        var lang =(navigator.language || navigator.systemLanguage
        || navigator.userLanguage ||"en")
            .substr(0,2).toLowerCase();
        var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
        var hcc = document.createElement("script");
        hcc.type ="text/javascript";
        hcc.async =true;
        hcc.src =("https:"== document.location.protocol ?"https":"http")
            +"://"+ url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
</script>
<!-- End SiteHeart code -->

<!--==============ANGULAR=========================-->

<script src="{{ asset('site/vendor/angular/angular.js') }}"></script>
<script src="{{ asset('site/vendor/angular-animate/angular-animate.js') }}"></script>
<script src="{{ asset('site/vendor/angular-sanitize/angular-sanitize.js') }}"></script>

<!--==============BOOTSTRAP=========================-->

<script src="{{ asset('site/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script>
    $('.phone-input').mask('+38 (000) 000-00-00');
</script>


<script src="{{ asset('site/vendor/angular-bootstrap/ui-bootstrap-tpls.min.js') }}"></script>
<!--==============================MAP=====================-->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDdycmfIt4XbYlFLw5138RsuKNLb_yUFA4"></script>
<script src="{{ asset('site/vendor/ngmap/build/scripts/ng-map.min.js') }}"></script>


<!--==============CARUSEL=========================-->
<script src="{{ asset('site/vendor/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ asset('site/vendor/angular-slick/dist/slick.min.js') }}"></script>

<!--==============RATING STAR=========================-->
<script src="{{ asset('site/vendor/angular-rating/src/angular-rating.js') }}"></script>


<script src="{{ asset('site/vendor/underscore/underscore.js') }}"></script>
<script src="{{ asset('site/vendor/angular-underscore-module/angular-underscore-module.js') }}"></script>

<script src="{{ asset('site/vendor/angular-filter/dist/angular-filter.js') }}"></script>
<script src="{{ asset('site/vendor/angular-multi-slider/multislider.js') }}"></script>

<!--==============APP=========================-->
<script src="{{ asset('site/js/app.js') }}"></script>

<script src="{{ asset('site/js/model/model.js') }}"></script>

<script src="{{ asset('site/js/services/searchService.js') }}"></script>
<script src="{{ asset('site/js/controllers/IndexCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/DiagnosticCtrl.js') }}"></script>

<script src="{{ asset('site/js/controllers/CatalogCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/ServiceCenterCtrl.js') }}"></script>
<script src="{{ asset('site/js/controllers/SearchController.js') }}"></script>

</body>
</html>
