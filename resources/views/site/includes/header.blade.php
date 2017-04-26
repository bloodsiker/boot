
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="banner"></div>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row top-bar">
        <div class="col-md-4 col-md-offset-3 col-xs-12">
            <span class="phone">0 800 256-357</span> <span class="sub-phone">Подберем СЦ <br> быстро и бесплатно</span>
        </div>
        <div class="col-md-4 col-md-offset-1 text-right">
            @if(Auth::check())
                <a href="{{ route('cabinet') }}" class="sign-in">В кабинет</a> |
                <a href="{{ route('cabinet.logout') }}" class="exit">Выход</a>
            @else
                <a href="{{ route('service.login') }}" class="sign-in">Вход</a> |
                <a href="{{ route('service.registration') }}" class="registration">Зарегистрировать сервис-центр</a>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row nav-bar">
        <div class="col-md-2">
            <img src="{{ asset('site/img/logo.png') }}" alt="boot">
        </div>
        <div class="col-md-6">
            <ul>
                <li><a href="{{ route('main') }}" class="{{ active('main') }}">Главная</a></li>
                <li><a href="{{ route('catalog') }}" class="{{ active('catalog') }}">Каталог</a></li>
                <li><a href="{{ route('diagnostics') }} " class="{{ active('diagnostics') }}">Диагностика</a></li>
                <li><a href="{{ route('about') }}" class="{{ active('about') }}">О нас</a></li>
                <li><a href="{{ route('support') }}" class="{{ active('support') }}">Служба поддержки</a></li>
            </ul>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <form action="/search" ng-mouseleave="show = false" method="get" class="top-search" ng-controller="TopSearchCtrl">
                    <input type="text" name="search" ng-model="text" class="form-control slide"
                           ng-if="show" placeholder="Поиск" required>
                <button class="btn btn-warning" type="submit" ng-mouseenter="show = true"><i
                            class="glyphicon glyphicon-search"></i></button>
            </form>
        </div>
    </div>
</div>
<hr>
