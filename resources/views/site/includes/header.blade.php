<div style="position: relative;z-index: 2;background: #fff;">
    <div class="container" id="header">
        <div class="row">
            <div class="col-md-12">

                {{--<nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-mobile" aria-expanded="false">
                                <span class="sr-only">Меню</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/">
                                <img style="width: 50px;background: #ffca13;padding: 3px;margin-top: -16px;" src="{{ asset('site/img/logo.png') }}" alt="boot">
                            </a>
                        </div>


                        <div class="collapse navbar-collapse" id="navbar-mobile">
                            <ul class="nav navbar-nav">
                                <li class="{{ active('main') }}"><a href="{{ route('main') }}">Главная</a></li>
                                <li class="{{ active('diagnostics') }}"><a href="{{ route('diagnostics') }}">Диагностика</a></li>
                                <li class="{{ active('about') }}"><a href="{{ route('about') }}">О проекте</a></li>
                                <li class="{{ active('support') }}"><a href="{{ route('support') }}">Служба поддержки</a></li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">

                                @if(Auth::user())
                                    @if(Auth::user()->roleSc())
                                        <li><a href="{{ route('cabinet.dashboard') }}" class="sign-in">В кабинет</a></li>
                                        <li><a href="{{ route('cabinet.logout') }}" class="registration">Выйти</a></li>
                                    @elseif(Auth::user()->roleUser())
                                        <li><a href="{{ route('user.dashboard') }}" class="sign-in">В профиль</a></li>
                                        <li><a href="{{ route('user.logout') }}" class="registration">Выйти</a></li>
                                    @elseif(Auth::user()->roleAdmin())
                                        <li><a href="{{ route('cabinet.admin.user.list') }}" class="sign-in">В кабинет</a></li>
                                        <li><a href="{{ route('cabinet.logout') }}" class="registration">Выйти</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('user.login') }}" class="sign-in">Пользователь</a></li>
                                    <li><a href="{{ route('service.login') }}" class="registration">Сервисный центр</a></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </nav>--}}


                <div class="nav-bar">
                    <a href="/">
                        <div class="logo-box">
                            <img src="{{ asset('site/img/logo.png') }}" alt="boot">
                        </div>
                    </a>
                    <div style="width: 100%;display: flex;flex-direction: column;">
                        <div class="top-menu col-xs-12">
                            <div class="menu">
                                <a href="{{ route('main') }}" class="{{ active('main') }}">Главная</a>
                                {{--<a href="{{ route('catalog') }}" class="{{ active('catalog') }}">Каталог</a>--}}
                                <a href="{{ route('diagnostics') }} " class="{{ active('diagnostics') }}">Диагностика</a>
                                <a href="{{ route('about') }}" class="{{ active('about') }}">О проекте</a>
                                <a href="{{ route('support') }}" class="{{ active('support') }}">Служба поддержки</a>
                            </div>
                            <div class="text-right sign-box">
                                {{--<a style="font-size: 24px; white-space: nowrap; text-decoration: none;" href="tel:0800256357"><span class="glyphicon glyphicon-phone-alt"></span> 0 800 256-357</a>--}}
                                {{--<br>--}}
                                @if(Auth::user())
                                    @if(Auth::user()->roleSc())
                                        <a href="{{ route('cabinet.dashboard') }}" class="sign-in">В кабинет</a> |
                                        <a href="{{ route('cabinet.logout') }}" class="registration">Выйти</a>
                                    @elseif(Auth::user()->roleUser())
                                        <a href="{{ route('user.dashboard') }}" class="sign-in">В профиль</a> |
                                        <a href="{{ route('user.logout') }}" class="registration">Выйти</a>
                                    @elseif(Auth::user()->roleAdmin())
                                        <a href="{{ route('cabinet.admin.user.list') }}" class="sign-in">В кабинет</a> |
                                        <a href="{{ route('cabinet.logout') }}" class="registration">Выйти</a>
                                    @endif
                                @else
                                    <a href="{{ route('user.login') }}" class="sign-in">Пользователь</a> |
                                    <a href="{{ route('service.login') }}" class="registration">Сервисный центр</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

