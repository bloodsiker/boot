@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'CatalogCtrl')


@section('content')

    <div style="position: relative;z-index: 2;background: #fff;" ng-cloak>
        <div class="container" style="position: relative;z-index: 2;">
            <div class="search-catalog">
                <!--======================================= INCLUDE SEARCH SC =======================================-->
            @include('site.includes.search')

            <!--=======================================SERVICE=====================================-->

                <div>
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

                        <div uib-dropdown auto-close="outsideClick" is-open="openedTime">
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
                                                <select name="weekDay" class="form-control"  ng-model="timeFilter.day">
                                                    <option ng-repeat="day in week_days" value="@{{day}}">@{{day}}</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div  style="float: left;margin-left: 10px; margin-right: 10px;margin-left: 10px;">
                                            <label>Начало дня
                                                <div uib-timepicker ng-model="timeFilter.start_time" show-spinners="false" show-meridian="ismeridian"></div>
                                            </label>
                                        </div>
                                        <div  style="float: left;">
                                            <label>Конец дня
                                                <div uib-timepicker ng-model="timeFilter.end_time" show-spinners="false" show-meridian="ismeridian"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="button" class="btn btn-black" ng-click="clear_time(); openedTime = false">Сбросить</button>
                                    <button class="btn btn-yellow" ng-click="applyTime(); openedTime = false">Выбрать</button>
                                </div>
                            </div>
                        </div>

                        <div uib-dropdown auto-close="outsideClick" is-open="isOpenRadius">
                            <span class="filter-panel" uib-dropdown-toggle>
                                Радиус <span class="glyphicon glyphicon-chevron-down"></span>
                            </span>
                            <div class="popover bottom fade in" style="top: 20px; left: 0; min-width: 250px;" uib-dropdown-menu>
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

                    </div>

                    <div style="padding-left: 15px;">
                        <div ng-if="filterService.length > 0"
                             class="chips btn btn-yellow slide"
                             ng-repeat="filter in filterService track by $index"
                             ng-click="removeFilterService($index, filter)">
                            @{{filter}} <span class="glyphicon glyphicon-remove"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=======================================CATALOG=======================================-->

    <div class="container-fluid" style="min-height: 100vh;">

        <div class="row">
            <div class="col-sm-6 col-xs-12">

                <!--=======================================SORT=======================================-->
                <div class="row sort">
                    <div class="col-xs-12">
                    <span>Сортировать:
                        <span ng-class="{active: activeSort == ''}" ng-click="order_event('')" class="sort-by active">по популярности <i ng-if="activeSort == ''" class="glyphicon glyphicon-sort-by-attributes-alt"></i></span>
                        <span ng-class="{active: activeSort == 'rating'}" ng-click="order_event('rating')" class="sort-by">по рейтингу <i ng-if="activeSort == 'rating'" class="glyphicon glyphicon-sort-by-attributes-alt"></i></span>
                        <span ng-class="{active: activeSort == 'comments'}" ng-click="order_event('comments')" class="sort-by">по отзывам  <i ng-if="activeSort == 'comments'"  class="glyphicon glyphicon-sort-by-attributes-alt"></i></span>
                    </span>
                    </div>
                </div>

                <!--=======================need help=======================-->
                <div class="row need-help-catalog">
                    <div class="col-md-12 text-center">
                        <h3>Нужна помощь <br> в подборе сервис-центра?</h3>
                        <p>Оставьте свой телефон, мы перезвоним в течение 3 минут и <br> бесплатно подберем вам
                            идеальный
                            сервис-центр</p>
                        <button class="btn btn-black" data-toggle="modal" data-target="#help_modal">Подобрать</button>
                    </div>
                </div>
                <!--=======================end need help=======================-->
                <div class="row" ng-if="catalog.length == 0">
                    <div class="col-xs-12 text-center">
                        <div class="not-result">Не найдено</div>
                    </div>
                </div>
                <!--=======================================CATALOG ITEM=======================================-->
                <div class="row catalog-item"
                     ng-repeat="item in catalog | limitTo: limitCatalog | orderBy: order_by ">

                    <div class="col-md-8">
                        <a class="title-sc" ng-href="@{{ '/sc/'+item.id }}" ng-bind="item.service_name"></a>
                        <div class="info-sc">
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="text" ng-bind="'Сегодня: c '+ item.work_days[week_day-1].start_time+' по '+item.work_days[week_day-1].end_time"></span>

                            <span uib-dropdown auto-close="outsideClick" is-open="openedServiceMore">
                            <span style="font-size: 10px; cursor: pointer;" uib-dropdown-toggle>Посмотреть все</span>
                                <div class="popover bottom fade in" style="top: 20px;" uib-dropdown-menu>
                                    <div style="left: 20px;" class="arrow"></div>
                                    <div class="popover-inner">
                                        <div class="popover-content" ng-mouseleave="openedServiceMore = false">
                                            <ul>
                                                <li style="list-style: none;"
                                                    ng-repeat="work in item.work_days"
                                                    ng-style="{'font-weight': $index == week_day-1 ? '900' : 'normal', color: $index == week_day-1 ? '#000' : ''}"
                                                    ng-bind="work.title + ' ' + (work.weekend == 1 ? 'выходной' : work.start_time + ' - '+ work.end_time)"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </span>

                            <div>
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <span class="text" ng-bind="item.address+ (item.number_h ? ', '+item.number_h : '')"></span>
                            </div>
                            <div ng-if="item.number_h_add" class="text" ng-bind="item.number_h_add"></div>
                            <div>
                                <span style="font-weight: 900;">M</span>
                                <span class="text" ng-bind="item.metro.address"></span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex; flex-direction: column;">
                        <img ng-if="item.logo" class="logo-cs" ng-src="@{{item.logo}}" alt="@{{item.service_name}}">

                        <div style="flex: auto"></div>
                        <rating value="item.rating" disabled max="5"></rating>
                        <div class="text-right">
                            <span class="glyphicon glyphicon-comment"></span>
                            <span ng-bind="(item.comments | number) + ' отзывов'"></span>
                        </div>
                        <button class="btn btn-yellow" data-toggle="modal" data-target="#call_modal" ng-click="openScCall(item.id)">Связаться</button>

                    </div>
                </div>

                <div class="row" ng-if="catalog.length > 0 && catalog.length >= limitCatalog">
                    <div class="col-xs-12 text-center">
                        <button ng-click="limitCatalogCount()" style="margin-bottom: 20px;" class="btn btn-yellow">Показать еще</button>
                    </div>
                </div>

                <!--=======================end item=====================================-->


            </div>
            <div class="col-sm-6 hidden-xs catalog-map">

                <ng-map id="map"
                        style="position: fixed; top: 0; width:inherit; z-index:1;">

                    <info-window id="foo">
                        <div ng-non-bindable="">
                            <img ng-if="info.logo" class="logo-cs" ng-src="@{{info.logo}}" alt="@{{info.service_name}}">
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
                                <div>
                                    <span style="font-weight: 900;">M</span>
                                    <span class="text" ng-bind="info.metro.address"></span>
                                </div>



                            </div>
                            <a ng-href="@{{ '/sc/'+info.id }}" style="margin-bottom: 0;" class="btn btn-black" >Посмотреть</a>
                            <button style="margin-bottom: 0;" class="btn btn-yellow" data-toggle="modal" data-target="#call_modal" ng-click="openScCall(info.id)">Связаться</button>
                        </div>
                    </info-window>

                    <marker
                            position="@{{item.c1}}, @{{item.c2}}"
                            fit="true"
                            ng-repeat="item in catalog"
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

@endsection
