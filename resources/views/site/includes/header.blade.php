<div style="position: relative;z-index: 2;background: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-bar">
                    <a href="/"><div style="padding: 5px; width: 100px;">
                            <img src="{{ asset('site/img/logo.png') }}" alt="boot">
                        </div></a>
                    <div style="width: 100%;display: flex;flex-direction: column;">
                        <div class="top-menu">
                            <div class="menu">
                                <a href="{{ route('main') }}" class="{{ active('main') }}">Главная</a>
                                <a href="{{ route('catalog') }}" class="{{ active('catalog') }}">Каталог</a>
                                <a href="{{ route('diagnostics') }} " class="{{ active('diagnostics') }}">Диагностика</a>
                                <a href="{{ route('about') }}" class="{{ active('about') }}">О нас</a>
                                <a href="{{ route('support') }}" class="{{ active('support') }}">Служба поддержки</a>
                            </div>
                            <div class="text-right">
                                {{--<a style="font-size: 24px; white-space: nowrap; text-decoration: none;" href="tel:0800256357"><span class="glyphicon glyphicon-phone-alt"></span> 0 800 256-357</a>--}}
                                {{--<br>--}}
                                @if(Auth::check())
                                    <a href="{{ route('cabinet.dashboard') }}" class="sign-in">В кабинет</a> |
                                    <a href="{{ route('cabinet.logout') }}" class="exit">Выход</a>
                                @else
                                    <a href="{{ route('service.login') }}" class="sign-in">Вход</a> |
                                    <a href="{{ route('service.registration') }}" class="registration">Зарегистрировать сервис-центр</a>
                                @endif
                            </div>
                        </div>
                        <div class="search-box">
                            <form action="/search" method="get">
                                <input type="text" placeholder="Поиск" style="width: 100%;">
                                <button class="btn search-button"><span class="glyphicon glyphicon-search"></span></button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

