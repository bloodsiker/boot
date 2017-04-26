@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'CatalogCtrl')


@section('content')

    <div class="search-catalog">
        <div class="container">

            <!--======================================= INCLUDE SEARCH SC =======================================-->
        @include('site.includes.search')

        <!--=======================================SERVICE=====================================-->

            <div class="row">
                <div class="col-xs-12 filters">
                    <div uib-dropdown auto-close="outsideClick" is-open="openedService">
                        <span class="filter-panel"
                              uib-dropdown-toggle>
                            Услуга <span class="glyphicon glyphicon-chevron-down"></span>
                        </span>
                        <div class="popover bottom fade in" style="top: 20px; left: 0;" uib-dropdown-menu
                             ng-mouseleave="openedService =
                        false">
                            <div class="arrow" style="left: 30px;"></div>
                            <div class="popover-inner">
                                <div class="popover-content">
                                    <div ng-repeat="item in [1,2,3,4,5,6,7,8]">
                                        <label>
                                            <input type="checkbox" ng-model="value1"> @{{ item }} Value
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--=======================================TIME=======================================-->

                    <div uib-dropdown auto-close="outsideClick" is-open="openedTime">
                        <span class="filter-panel"
                              uib-dropdown-toggle>
                            Время работы <span class="glyphicon glyphicon-chevron-down"></span>
                        </span>


                        <div class="popover bottom fade in"
                             style="top: 20px"
                             uib-dropdown-menu
                             ng-mouseleave="openedTime = false"
                             >
                            <div class="arrow" style="left: 30px;"></div>
                            <div class="popover-inner">
                                <div class="row datapicker">
                                    <div class="col-md-6">
                                        <span>Начало дня</span>
                                        <div uib-timepicker ng-model="start_time" show-spinners="false"
                                             show-meridian="ismeridian"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <span>Конец дня</span>
                                        <div uib-timepicker ng-model="end_time" show-spinners="false"
                                             show-meridian="ismeridian"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger" ng-click="clear_time()">Сбросить</button>
                                <button class="btn btn-warning" ng-click="select_time(start_time, end_time)">Выбрать</button>
                            </div>
                        </div>
                    </div>

                    <!--=======================================SERVICE MORE=======================================-->
                    <div uib-dropdown auto-close="outsideClick" is-open="openedServiceMore">
                        <span class="filter-panel"
                              uib-dropdown-toggle>
                            Дополнительные условия <span class="glyphicon glyphicon-chevron-down"></span>
                        </span>
                        <div class="popover bottom fade in" style="top: 20px;" uib-dropdown-menu
                             ng-mouseleave="openedServiceMore =
                        false">
                            <div class="arrow"></div>
                            <div class="popover-inner">
                                <div class="popover-content">
                                    <div ng-repeat="item in [1,2,3,4,5,6,7,8]">
                                        <label>
                                            <input type="checkbox" ng-model="value1"> @{{ item }} Value
                                        </label>
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

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6 col-xs-12">

                <!--=======================================SORT=======================================-->
                <div class="row sort">
                    <div class="col-xs-12">
                    <span>Сортировать:
                        <span ng-class="{active: activeSort == ''}" ng-click="order_event('')" class="sort-by active">по популярности <i
                                    class="glyphicon glyphicon-sort-by-attributes-alt"></i></span>
                        <span ng-class="{active: activeSort == 'rating'}" ng-click="order_event('rating')"
                              class="sort-by">по рейтингу <i
                                    class="glyphicon glyphicon-sort-by-attributes-alt"></i></span>
                        <span ng-class="{active: activeSort == 'comments'}" ng-click="order_event('comments')"
                              class="sort-by">по отзывам  <i
                                    class="glyphicon glyphicon-sort-by-attributes-alt"></i></span>
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
                        <button class="btn btn-warning" data-toggle="modal" data-target="#help_modal">Подобрать</button>
                    </div>
                </div>
                <!--=======================end need help=======================-->
                <div class="row" ng-if="filtered_catalog.length == 0">
                    <div class="col-xs-12 text-center">
                        <div class="not-result">Не найдено</div>
                    </div>
                </div>
                <!--=======================================CATALOG ITEM=======================================-->
                @{{timeStartFilter}}
                <div class="row catalog-item"
                     ng-repeat="item in catalog
                     |orderBy: order_by

                     | filterBy: ['street', 'metro.address', 'district.address']: addressFilter
                     | filterBy: ['radius'] : true
                     | filterBy: ['start_time'] : index.start_time <= timeStartFilter ? 'rg' : index.start_time
                     | filterBy: ['manufacturers']: manufacturerFilter as filtered_catalog">



                    {{----}}
                    {{--| filterBy: ['end_time'] : '20:00'--}}

                    <div class="col-md-4 col-xs-12">
                        <div class="title-sc visible-xs"><a ng-href="@{{ '/sc/'+item.id }}" ng-bind="item
                        .service_name"></a></div>
                        <img class="logo-cs" ng-src="@{{item.logo.length > 0 ? item.logo : 'site/img/logo-sc.png'}}"
                             alt="@{{item.service_name}}">

                        <div class="info-sc">
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="text" ng-bind="item.work_time"></span>
                        </div>
                        <div class="info-sc">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <span class="text" ng-bind="item.address"></span>
                        </div>
                        <div class="info-sc" ng-if="item.metro">
                            <span class="glyphicon glyphicon-magnet"></span>
                            <span class="text" ng-bind="item.metro.address"></span></div>
                        <button class="btn btn-warning hidden-xs"
                                data-toggle="modal"
                                data-target="#call_modal"
                                ng-click="openScCall(item.id)">Связаться
                        </button>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="title-sc hidden-xs"><a ng-href="@{{ '/sc/'+item.id }}" ng-bind="item
                        .service_name"></a></div>
                        <div class="tag" ng-if="item.tags.length > 0" ng-repeat="tag in item.tags" ng-bind="tag.tag"></div>
                        <button class="btn btn-warning visible-xs"
                                data-toggle="modal"
                                data-target="#call_modal"
                                ng-click="openCall(item)">Связаться
                        </button>
                        <div class="visible-xs rating-end-comments-xs">
                            <div class="rating-xs">
                                <div><span class="glyphicon glyphicon-star"></span></div>
                                <div class="count" ng-bind="item.rating | number"></div>
                                <div>рейтинг</div>
                            </div>
                            <div class="comments-xs">
                                <div><span class="glyphicon glyphicon-comment"></span></div>
                                <div class="count" ng-bind="item.comments | number"></div>
                                <div>отзывов</div>
                            </div>
                        </div>

                    </div>
                    <div class="rating hidden-xs">
                        <div><span class="glyphicon glyphicon-star"></span></div>
                        <div class="count" ng-bind="item.rating | number"></div>
                        <div>рейтинг</div>
                    </div>
                    <div class="comments hidden-xs">
                        <div><span class="glyphicon glyphicon-comment"></span></div>
                        <div class="count" ng-bind="item.comments | number"></div>
                        <div>отзывов</div>
                    </div>
                </div>

                <!--=======================end item=====================================-->


            </div>
            <div class="col-sm-6 hidden-xs catalog-map">

                <ng-map id="map"
                        data-spy="affix"
                        ng-class="{fix_map: filtered_catalog.length <= 1}"
                        data-offset-top="438"
                        zoom-to-include-markers="auto"
                >

                    <info-window id="foo">
                        <div ng-non-bindable="">
                            <h1 ng-bind="info.service_name"></h1>
                            <button class="btn btn-warning" data-toggle="modal"
                                    data-target="#call_modal"
                                    ng-click="openCall(info)">Связаться
                            </button>
                            <div class="info-sc"><span class="glyphicon glyphicon-time"></span> <span
                                        ng-bind="info.work_time"></span></div>
                            <div class="info-sc"><span class="glyphicon glyphicon-map-marker"></span> <span
                                        ng-bind="info.address"></span>
                            </div>
                            <div class="info-sc" ng-if="info.metro"><span class="glyphicon glyphicon-road"></span> <span
                                        ng-bind="info.metro.address"></span></div>
                        </div>
                    </info-window>

                    <marker
                            position="@{{item.c1}}, @{{item.c2}}"
                            ng-repeat="item in filtered_catalog"
                            on-click="showInfo(event, item)"
                            icon="{url:'site/img/marker-map.png'}">

                    </marker>
                </ng-map>
            </div>
        </div>


    </div>

@endsection
