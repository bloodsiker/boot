@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('og:image', asset('site/img/index.jpg'))

@section('controller', 'CatalogCtrl')


@section('content')

    <div style="position: relative;z-index: 1;background: #fff;" ng-cloak>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="home">
                        {{--<h1>Мгновенный поиск сервисных центров по <br> ремонту смартфонов в Днепре</h1>
                        <h2>Наш сервис помогает владельцам смартфонов, сэкономить <br> время и деньги на качественный ремонт устройства, тем, что
                            <br> позволяет найти ближайший сертифицированный сервис-центр <br> за 3 минуты</h2>--}}
                        {{--<a href="{{ route('catalog') }}" class="btn btn-yellow">Найти ближайший сервис-центр</a>--}}

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <!--======================================= INCLUDE SEARCH SC =======================================-->
                                @include('site.includes.search')

                                <div class="text-left" style="user-select: none">
                                    <div class="filters" style="min-width: 320px;">
                                        <div uib-dropdown auto-close="outsideClick" is-open="isOpenServices">
                            <span class="filter-panel" uib-dropdown-toggle>
                                Услуга <span class="glyphicon glyphicon-chevron-down"></span>
                            </span>
                                            <div class="popover bottom fade in" style="top: 20px; left: 0;" uib-dropdown-menu>
                                                <div class="arrow" style="left: 30px;"></div>
                                                <div class="popover-inner">
                                                    <div class="popover-content">
                                                        <div ng-repeat="service in services" ng-click="selectFilterServices(service)" style="cursor: pointer;">
                                                            <div class="checkbox" ng-class="{'active': service.active}"></div>
                                                            @{{ service.title }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-black" ng-click="clearFilterServices(); isOpenServices = false">Сбросить</button>
                                                <button class="btn btn-yellow" ng-click="applyFilterServices(); isOpenServices = false">Применить</button>
                                            </div>
                                        </div>
                                        <!--=======================================TIME=======================================-->

                                        <div uib-dropdown apped-to-body="true" auto-close="outsideClick" is-open="openedTime">
                                            <span class="filter-panel"
                                                  uib-dropdown-toggle>
                                                Время работы <span class="glyphicon glyphicon-chevron-down"></span>
                                            </span>

                                            <div class="popover bottom fade in" style="top: 20px;"uib-dropdown-menu>
                                                <div class="arrow" style="left: 30px;"></div>
                                                <div class="popover-inner">
                                                    <div class="datapicker">
                                                        <div style="float: left;">
                                                            <label>День недели
                                                                <select name="weekDay" class="form-control"  ng-model="_timeFilter.day">
                                                                    <option ng-repeat="(day_key, day) in week_days" value="@{{day}}">@{{day}}</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div  style="float: left;margin-left: 10px; margin-right: 10px;margin-left: 10px;">
                                                            <label>Начало дня
                                                                <div uib-timepicker ng-model="_timeFilter.start_time" show-spinners="false" show-meridian="ismeridian"></div>
                                                            </label>
                                                        </div>
                                                        <div  style="float: left;">
                                                            <label>Конец дня
                                                                <div uib-timepicker ng-model="_timeFilter.end_time" show-spinners="false" show-meridian="ismeridian"></div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <button type="button" class="btn btn-black" ng-click="clear_time(); openedTime = false">Сбросить</button>
                                                    <button class="btn btn-yellow" ng-click="applyTime(); openedTime = false">Выбрать</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div uib-dropdown apped-to-body="true" auto-close="outsideClick" is-open="isOpenRadius">
                            <span class="filter-panel" uib-dropdown-toggle tooltip-append-to-body="true">
                                Радиус <span class="glyphicon glyphicon-chevron-down"></span>
                            </span>
                                            <div tooltip-append-to-body="true" class="popover bottom fade in" style="top: 20px; left: 0; min-width: 250px;" uib-dropdown-menu>
                                                <div class="arrow" style="left: 30px;"></div>
                                                <div class="popover-inner">
                                                    <div class="popover-content">
                                                        <div ng-repeat="radius_item in radiuses"
                                                             ng-click="selectFilterRadius(radius_item)" style="cursor: pointer;">
                                                            <div class="checkbox" ng-class="{'active': radius_item.active}"></div>
                                                            @{{ radius_item.title }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-black" ng-click="resetRadius(); isOpenRadius = false">Сбросить</button>
                                                <button class="btn btn-yellow" ng-click="applyRadius(); isOpenRadius = false">Применить</button>
                                            </div>
                                        </div>
                                        <div ng-if="filterService.length == 1" class="coast-range pull-right">
                            <span class="filter-panel">
                                Цена: до @{{ filterService[0].price_max }}грн
                            </span>
                                            <input style="display: block;vertical-align: top;"
                                                   type="range"
                                                   ng-if="filterService[0].price_max"
                                                   min="@{{ filterService[0]._price_min+1 }}"
                                                   max="@{{ filterService[0]._price_max }}"
                                                   step="1" ng-model="filterService[0].price_max">

                                            <div style="width: 200px; margin-top: 5px; vertical-align: bottom;">
                                                <input type="number" style="width: 33%;" step="0.01" ng-model="filterService[0].price_min">
                                                <span style="color: #ffffff;">грн</span>
                                                <input type="number" style="width: 33%; margin-left: 12px;"  step="0.01" ng-model="filterService[0].price_max">
                                                <span style="color: #ffffff;">грн</span>

                                            </div>

                                        </div>

                                    </div>

                                    <div style="padding-left: 15px;">
                                        <div ng-if="filterService.length > 0"
                                             class="chips btn btn-yellow fade"
                                             ng-repeat="filter in filterService track by $index"
                                             ng-click="removeFilterService($index, filter)">
                                            @{{filter.title}} <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                        <div ng-if="timeFilter"
                                             class="chips btn btn-yellow fade"
                                             ng-click="removeFilterTime()">
                                            @{{_timeFilter.day}} c @{{ _timeFilter.start_time | date: 'HH:mm' }} до @{{ _timeFilter.end_time | date: 'HH:mm' }} <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>

                                    <div ng-if="catalog.length" style="padding-left: 15px; margin-top: 20px;">
                                        <span style="color: #ffca13;">Найдено <span class="h4">@{{ catalog.length }}</span> сервисных центров, соответствующих Вашему запросу </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--=======================================CATALOG=======================================-->

    <div class="container" style="min-height: 100vh; position: relative; z-index: 0">

        <div class="row" style="display: flex; align-items: stretch;">
            <div class="col-sm-6 col-lg-5 col-xs-12">

                <!--=======================================SORT=======================================-->
                <div class="row" style="padding-top: 10px;">
                    <div class="col-xs-12">
                        <div style="position: relative;">
                            <label for="sortCatalog">Сортировать по: </label>
                            <div class="input-group">
                                <select class="form-control" ng-model="activeSort" ng-change="order_event(activeSort)" name="sortCatalog" id="sortCatalog">
                                    <option value="service_name">названию</option>
                                    <option value="visits">популярности</option>
                                    <option value="rating">рейтингу</option>
                                    <option value="comments">отзывам</option>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-yellow" type="button" ng-click="reverseCatalog = !reverseCatalog">
                                        <i ng-if="!reverseCatalog" style="transform: translateY(3px);" class="glyphicon glyphicon-chevron-down"></i>
                                        <i ng-if="reverseCatalog" class="glyphicon glyphicon-chevron-up"></i>
                                    </button>
                                </span>
                            </div>

                        </div>

                    </div>
                </div>

                {{--<!--=======================need help=======================-->
                <div class="row need-help-catalog">
                    <div class="col-md-12 text-center">
                        <h3>Нужна помощь <br> в подборе сервис-центра?</h3>
                        <p>Оставьте свой телефон, мы перезвоним в течение 3 минут и <br> бесплатно подберем вам
                            идеальный
                            сервис-центр</p>
                        <button class="btn btn-black" data-toggle="modal" data-target="#help_modal">Подобрать</button>
                    </div>
                </div>--}}
                <!--=======================end need help=======================-->
                <div class="row" ng-if="catalog.length == 0">
                    <div class="col-xs-12 text-center">
                        <div class="not-result">Не найдено</div>
                    </div>
                </div>
                <!--=======================================CATALOG ITEM=======================================-->
                <div class="row catalog-item"
                     ng-repeat="item in catalog | limitTo: limitCatalog | orderBy: activeSort: reverseCatalog">

                    <div class="col-md-8">
                        <a class="title-sc" ng-href="@{{ '/sc/'+item.id }}" ng-bind="item.service_name"></a>
                        <div class="info-sc">
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="text" ng-bind="'Сегодня: c '+ item.work_days[indexDay].start_time+' по '+item.work_days[indexDay].end_time"></span>

                            <span uib-dropdown auto-close="outsideClick">
                            <span style="font-size: 10px; cursor: pointer;" uib-dropdown-toggle>Посмотреть все</span>
                                <div class="popover bottom fade in" style="top: 12px;" uib-dropdown-menu>
                                    <div style="left: 20px;" class="arrow"></div>
                                    <div class="popover-inner">
                                        <div class="popover-content">
                                            <ul>
                                                <li style="list-style: none;"
                                                    ng-repeat="work in item.work_days"
                                                    ng-style="{'font-weight': $index == indexDay ? '900' : 'normal', color: $index == indexDay ? '#000' : ''}"
                                                    ng-bind="work.title + ' ' + (work.weekend == 1 ? 'выходной' : work.start_time + ' - '+ work.end_time)"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </span>

                            <div>
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <span class="text" ng-bind="item.address"></span>
                            </div>
                            <div ng-if="item.number_h_add" class="text" ng-bind="item.number_h_add"></div>
                            <div ng-if="info.metro.address">
                                <span style="font-weight: 900;">M</span>
                                <span class="text" ng-bind="item.metro.address"></span>
                            </div>
                            <a class="btn btn-yellow btn-call" ng-click="sendCallSCCatalog(item.id)">
                                Заказать
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <img ng-if="item.logo" class="logo-cs" style="width: 150px;" ng-src="@{{item.logo}}" alt="@{{item.service_name}}">

                        <div class="text-right badge-catalog">
                            <span class="glyphicon glyphicon-comment"></span>
                            <span style="vertical-align: text-bottom;" ng-bind="(item.comments | number)"></span>
                        </div>
                        <div class="text-right badge-catalog">
                            <span class="glyphicon glyphicon-star"></span>
                            <span style="vertical-align: text-bottom;" ng-bind="(item.rating | number)"></span>
                        </div>

                        <div ng-hide="true" class="text-right" uib-tooltip="Избранное" style="float: right;">
                            <span style="font-size: 18px; cursor: pointer; vertical-align: text-top;"
                                  ng-if="true"
                                  ng-click="like(item)"
                                  ng-style="{color: item.favorite ? 'red': ''}"
                                  ng-class="{'glyphicon-heart-empty': !item.favorite, 'glyphicon-heart': item.favorite}"
                                  class="glyphicon"></span>
                        </div>

                    </div>

                </div>

                <div class="row" ng-if="catalog.length > 0 && catalog.length >= limitCatalog">
                    <div class="col-xs-12 text-center">
                       {{-- <div class="text-center">
                            <ul uib-pagination
                                first-text="<<"
                                last-text=">>"
                                previous-text="<"
                                next-text=">"
                                total-items="catalog.length"
                                ng-model="catalogPage"
                                max-size="4"
                                class="pagination-sm"
                                boundary-links="true"
                                force-ellipses="true"></ul>
                        </div>--}}


                        <button ng-click="limitCatalogCount()" style="margin-bottom: 20px;" class="btn btn-yellow">Показать еще</button>
                    </div>
                </div>

                <!--=======================end item=====================================-->


            </div>
            <div class="col-sm-6 col-lg-7 hidden-xs catalog-map">

                <div style="position: sticky; position: -webkit-sticky;position: -moz-sticky;position: -ms-sticky;position: -o-sticky;top: 0px;">
                    <ng-map id="map"
                        center='current-position'
                        geo-callback="callbackFunc('you')">

                    <info-window id="foo">
                        <div ng-non-bindable="">
                            <img ng-if="info.logo" class="logo-cs" style="width: 120px;" ng-src="@{{info.logo}}" alt="@{{info.service_name}}">
                            <rating value="item.rating" disabled max="5"></rating>
                            <a style="font-size: 20px; color: #000;" class="title-sc" ng-href="@{{ '/sc/'+info.id }}" ng-bind="info.service_name"></a>
                            <div style="margin-top: 10px; margin-bottom: 10px;" class="info-sc">
                                <span class="glyphicon glyphicon-time"></span>
                                <span class="text" style="font-weight: bold; font-size: 15px;" ng-bind="'Сегодня: c '+ info.work_days[week_day-1].start_time+' по '+info.work_days[week_day-1].end_time"></span>
                                <ul>
                                    <li style="list-style: none;"
                                        ng-repeat="work in info.work_days"
                                        ng-style="{'font-weight': $index == week_day-1 ? '900' : 'normal', color: $index == week_day-1 ? '#000' : ''}"
                                        ng-bind="work.title + ' ' + (work.weekend == 1 ? 'выходной' : work.start_time + ' - '+ work.end_time)"></li>
                                </ul>

                                <div>
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                    <span class="text" ng-bind="info.address+ (info.number_h ? ', '+info.number_h : '')"></span>
                                </div>
                                <div ng-if="info.number_h_add" class="text" ng-bind="info.number_h_add"></div>
                                <div ng-if="info.metro.address">
                                    <span style="font-weight: 900;">M</span>
                                    <span class="text" ng-bind="info.metro.address"></span>
                                </div>



                            </div>
                            <a ng-href="@{{ '/sc/'+info.id }}" style="margin-bottom: 0;" class="btn btn-black" >Посмотреть</a>
                        </div>
                    </info-window>

                    <marker
                            position="@{{item.c1}}, @{{item.c2}}"
                            fit="true"
                            ng-repeat="item in catalog track by $index"
                            on-click="showInfo(event, item)"
                            icon="{url:'site/img/marker-map.png'}">

                    </marker>

                    <shape id="circle"
                           ng-if="address.address"
                           name="circle"
                           centered="true"
                           stroke-color='#ffca13'
                           stroke-opacity="0.3"
                           stoke-index="2"
                           stroke-weight="2"
                           center="@{{address.c1}}, @{{address.c2}}"
                           radius="@{{radiusMap}}"
                           editable="false" ></shape>

                </ng-map>
                </div>
            </div>
        </div>


    </div>

    <button ng-if="showButtonTop > 400" class="btn btn-small btn-yellow fade" style="position: fixed;right: 2px;bottom: 0;z-index: 10;height: 36px;" ng-click="topScroll()">
        <span class="glyphicon glyphicon-arrow-up"></span>
    </button>

@endsection
