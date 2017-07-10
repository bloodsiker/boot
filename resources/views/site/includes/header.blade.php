<div style="position: relative;z-index: 2;background: #fff;">
    <div class="container" id="header">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-bar">
                    <a href="/"><div style="padding: 5px; width: 100px; background-color: #ffca13;">
                            <img src="{{ asset('site/img/logo.png') }}" alt="boot">
                        </div></a>
                    <div style="width: 100%;display: flex;flex-direction: column;">
                        <div class="top-menu col-xs-12">
                            <div class="menu">
                                <a href="{{ route('main') }}" class="{{ active('main') }}">Главная</a>
                                <a href="{{ route('catalog') }}" class="{{ active('catalog') }}">Каталог</a>
                                <a href="{{ route('diagnostics') }} " class="{{ active('diagnostics') }}">Диагностика</a>
                                <a href="{{ route('about') }}" class="{{ active('about') }}">О проекте</a>
                                <a href="{{ route('support') }}" class="{{ active('support') }}">Служба поддержки</a>
                            </div>
                            <div class="text-right">
                                {{--<a style="font-size: 24px; white-space: nowrap; text-decoration: none;" href="tel:0800256357"><span class="glyphicon glyphicon-phone-alt"></span> 0 800 256-357</a>--}}
                                {{--<br>--}}
                                @if(Auth::user())
                                    @if(Auth::user()->roleSc())
                                        <a href="{{ route('cabinet') }}" class="sign-in">В кабинет</a> |
                                        <a href="{{ route('cabinet.logout') }}" class="registration">Выйти</a>
                                    @elseif(Auth::user()->roleUser())
                                        <a href="{{ route('user.dashboard') }}" class="sign-in">В профиль</a> |
                                        <a href="{{ route('user.logout') }}" class="registration">Выйти</a>
                                    @endif
                                @else
                                    <a href="{{ route('user.login') }}" class="sign-in">Пользователь</a> |
                                    <a href="{{ route('service.login') }}" class="registration">Сервисный центер</a>
                                @endif
                            </div>
                        </div>
                        <div class="search-box" ng-controller="TopSearchCtrl">
                            <div class="form">
                                <input type="text"
                                       ng-model="filterTopSearch"
                                       ng-focus="getSearchData()"
                                       placeholder="Поиск сервисных центров / неисправностей"
                                       style="width: 100%;">
                                <button type="button" class="btn search-button"><span class="glyphicon glyphicon-search"></span></button>
                                <div ng-show="filterTopSearch" class="searched-box">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span style="font-size: 16px;">Сервисные центры</span>
                                            <div ng-repeat="service in catalog_search | filter: filterTopSearch | limitTo: 10 as filteredCatalog track by $index" style="cursor: pointer;">
                                                <a ng-href="@{{ '/sc/'+service.id }}" ng-bind="service.service_name"></a>
                                            </div>
                                            <div ng-if="filteredCatalog.length <= 0" style="font-size: 14px; color: #666;">Не найдено</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <span style="font-size: 16px;">Неисправности</span>
                                            <div ng-repeat="service in services_search | filter: filterTopSearch as filteredService track by $index" style="cursor: pointer;">
                                                <a href ng-click="selectServiceSearch(service)">@{{ service.title }}</a>
                                            </div>
                                            <div ng-if="filteredService.length <= 0" style="font-size: 14px; color: #666666;">Не найдено</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

