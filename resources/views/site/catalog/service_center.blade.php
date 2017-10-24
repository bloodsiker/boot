@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name . ' ' . $service_center->service_name)

@section('description', $data_seo[0]->description . ' ' . $service_center->service_name)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'PageServiceCenterCtrl')

@section('content')

    <div class="container page-sc">

        <div class="row" style="display: flex; align-items: stretch;">
            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-12">
                        <img class="logo-cs" style="width: 200px;" ng-src="@{{service_center.logo}}" alt="@{{service_center.service_name}}">
                    </div>
                    <div class="col-md-12">
                        <h1 class="title" ng-bind="service_center.service_name"></h1>
                    </div>

                </div>


                <div class="info-sc"><i class="glyphicon glyphicon-time"></i> <span class="text" style="font-size: 18px;" ng-bind="'Сегодня: c '+ service_center.work_days[week_day-1].start_time+' по '+service_center.work_days[week_day-1].end_time"></span></div>
                <ul style="margin-left: 17px;">
                    <li style="list-style: none;"
                        ng-repeat="work in service_center.work_days"
                        ng-style="{'font-weight': $index == week_day-1 ? '900' : 'normal', color: $index == week_day-1 ? '#000' : ''}"
                        ng-bind="work.title + ' ' + (work.weekend == 1 ? 'выходной' : work.start_time + ' - '+ work.end_time)"></li>
                </ul>
                <div class="info-sc"><span><i class="glyphicon glyphicon-map-marker"></i> Адрес:</span>
                    <span class="text" ng-bind="service_center.address"></span>
                </div>
                <div class="info-sc" ng-if="service_center.metro.address"><span><i class="glyphicon glyphicon-road"></i> Метро:</span> <span class="text" ng-bind="service_center.metro.address"></span></div>

                <h4 ng-if="service_center.exit_master === '1'"><span class="glyphicon glyphicon-wrench"></span> Выезд мастера</h4>

                <div class="row callback">
                    <div class="col-sm-6">
                        <button class="btn btn-yellow btn-call btn-lg" ng-click="openScCall(service_center)" style="width: 100%;">
                            Заказать
                        </button>
                    </div>

                </div>

                <div class="row text-center">
                    <hr>
                    <div class="col-sm-4 rating">
                        <div class="count" ng-bind="service_center.total_rating"></div>
                        <div>Рейтинг</div>
                    </div>
                    <div class="col-sm-4 comments">
                        <div class="count" ng-bind="service_center.total_comments"></div>
                        <div>Отзывов</div>
                    </div>
                    <div class="col-sm-4 comments">
                        <div class="count" ng-bind="service_center.count_clients"></div>
                        <div class="text-center">Обращений клиентов</div>
                    </div>
                </div>


                <!--=======================================BUY=======================================-->
                <div ng-if="service_center.price.length > 0">
                    <hr>
                    <h3 style="margin-top: 20px;">Примерная стоимость работ</h3>
                    <table ng-if="service_center.price.length > 0" class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Услуга</th>
                            <th>от</th>
                            <th>до</th>
                            <th>Валюта</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="item in service_center.price">
                            <td ng-bind="item.title"></td>
                            <td ng-bind="item.price_min"></td>
                            <td ng-bind="item.price_max"></td>
                            <td ng-bind="item.currency"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>



                <!--=======================================TAGS=======================================-->
                <div ng-if="service_center.tags.length > 0">
                    <hr>
                    <h3 style="margin-top: 20px;">Описание</h3>
                    <div class="tag" ng-repeat="item in service_center.tags" ng-bind="item.tag"></div>
                </div>

                <!--=======================================ABOUT=======================================-->
                <div ng-if="service_center.about">
                    <hr>
                    <h3>О компании</h3>
                    <p ng-bind-html="service_center.about"></p>
                </div>

                <div ng-if="service_center.advantages.length > 0">
                    <hr>
                    <h3>Преимущества</h3>
                    <ul>
                        <li ng-repeat="item in service_center.advantages" ng-bind="item.advantages"></li>
                    </ul>
                </div>

                <!--=======================================BRANDS=======================================-->
                <div ng-if="service_center.manufacturers.length > 0">
                    <hr>
                    <h3>Марки телефонов</h3>
                    <p><span ng-repeat="item in service_center.manufacturers" ng-bind="item.manufacturer + ', '"></span></p>
                </div>



                <!--=======================================PHOTOS=======================================-->
                <div ng-if="filteredPhotos">
                    <hr>
                    <h3>Фотографии</h3>
                    <div class="row photos">
                        <div ng-repeat="photo in service_center.service_photo | filter: 'service_photo' as filteredPhotos">
                            <div class="clearfix" ng-if="$index % 3 == 0"></div>
                            <div class="col-sm-6" >
                                <div style="overflow: hidden;">
                                    <img class="photo-item"
                                         width="200px"
                                         alt="@{{service_center.service_name}}"
                                         data-toggle="modal"
                                         data-target="#photoModal"
                                         ng-click="openPhoto(photo.path +photo.file_name)"
                                         ng-src="@{{photo.path +photo.file_name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--=======================================CERTIFICATE=======================================-->
                <div ng-if="filteredCertificate">
                    <hr>
                    <h3 >Сертификаты</h3>
                    <div class="row certificate">
                        <div ng-repeat="photo in service_center.service_photo | filter: 'certificate' as filteredCertificate">
                            <div class="clearfix" ng-if="$index % 3 == 0"></div>
                            <div class="col-sm-6" >
                                <div style="overflow: hidden;">
                                    <img class="photo-item" width="200px"
                                         alt="@{{service_center.service_name}}"
                                         data-toggle="modal"
                                         data-target="#photoModal"
                                         ng-click="openPhoto(photo.path + photo.file_name)"
                                         ng-src="@{{photo.path + photo.file_name}}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!--=======================================CERTIFICATE=======================================-->
                <div ng-if="filteredLicense">
                    <hr>
                    <h3>Лицензии</h3>
                    <div class="row certificate">
                        <div ng-repeat="photo in service_center.service_photo | filter: 'licenses' as filteredLicense">
                            <div class="clearfix" ng-if="$index % 3 == 0"></div>
                            <div class="col-sm-6" >
                                <div style="overflow: hidden;">
                                    <img class="photo-item"
                                         width="200px"
                                         alt="@{{service_center.service_name}}"
                                         data-toggle="modal"
                                         data-target="#photoModal"
                                         ng-click="openPhoto(photo.path + photo.file_name)"
                                         ng-src="@{{photo.path + photo.file_name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--=======================================PERSONAL SC=======================================-->

                <div class="col-xs-12 personal-sc" ng-if="service_center.personal.length > 0">
                    <hr>
                    <h3>Команда сервиса</h3>
                    <slick infinite=true
                           dots=true
                           slides-to-show=3
                           slides-to-scroll=3
                           ng-if="service_center.personal"
                           autoplay=true>

                        <div class="slick-item" ng-repeat="person in service_center.personal">
                            <div style="width: 100px; height: 100px; overflow: hidden;border-radius: 50%;">
                                <img ng-src="@{{ person.path + person.avatar }}" alt="@{{person.name}}" align="left"/>
                            </div>
                            <h4 ng-bind="person.name"></h4>
                            <p ng-if="person.info" ng-bind="person.info"></p>
                            <p ng-if="person.specialization" ng-bind="person.specialization"></p>
                            <p ng-if="person.work_exp" ng-bind="'Стаж: '+person.work_exp"></p>
                        </div>

                    </slick>
                </div>
            </div>
            <div class="col-md-6">
                <div style="position: sticky; position: -webkit-sticky;position: -moz-sticky;position: -ms-sticky;position: -o-sticky;top: 0px;">
                    <ng-map style="height: 100vh;" id="map" center="@{{service_center.c1}}, @{{service_center.c2}}" zoom="17">
                        <marker position="@{{service_center.c1}}, @{{service_center.c2}}" cursor="default" icon="{url:'/site/img/marker-map.png'}">
                        </marker>
                    </ng-map>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="comments-section">
                <div class="col-sm-10">
                    <h3>Отзывы</h3>
                    <span ng-bind="'Вот что говорят клиенты об ' + service_center.title"></span>
                </div>
                <div class="col-sm-2 text-right">
                    <button class="btn btn-yellow" data-toggle="modal" data-target="#add_comment_modal">Написать отзыв</button>
                </div>
            </div>
            <!--=======================================HEADER COMMENTS=======================================-->
            <div class="col-sm-12" style="margin-bottom: 20px;">
                <div class="comments-header">
                    <div class="row text-center">
                        <div class="col-sm-2">
                            <div class="total-comments" ng-bind="comments.list.length +' отзыва'"></div>
                            <rating value="comments.header.r_total_rating" max="5"></rating>
                            <div class="total-count"><span class="count" ng-bind="comments.header.r_total_rating"></span>/<span>5</span></div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-rating">Качество работ</div>
                            <rating value="comments.header.r_quality_of_work" max="5"></rating>
                            <div class="count-rating"><span class="count" ng-bind="comments.header.r_quality_of_work"></span><span>/5</span></div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-rating">Соблюдение сроков</div>
                            <rating value="comments.header.r_deadlines" max="5"></rating>
                            <div class="count-rating"><span class="count" ng-bind="comments.header.r_deadlines"></span><span>/5</span></div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-rating">Соблюдение стоимости</div>
                            <rating value="comments.header.r_compliance_cost" max="5"></rating>
                            <div class="count-rating"><span class="count" ng-bind="comments.header.r_compliance_cost"></span><span>/5</span></div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-rating">Цена/качество</div>
                            <rating value="comments.header.r_price_quality" max="5"></rating>
                            <div class="count-rating"><span class="count" ng-bind="comments.header.r_price_quality"></span><span>/5</span></div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-rating">Обслуживание</div>
                            <rating value="comments.header.r_service" max="5"></rating>
                            <div class="count-rating"><span class="count" ng-bind="comments.header.r_service"></span><span>/5</span></div>
                        </div>
                    </div>
                </div>

            </div>
            <!--=======================================COMMENTS LIST=======================================-->
            <div class="col-sm-12">
                <!--=======================================COMMENT ITEM=======================================-->
                <div class="row comment-item" ng-repeat="item in comments.list">
                    <div class="col-sm-3">
                        <div class="rating"><span class="count" ng-bind="item.r_total_rating"></span> <span class="glyphicon glyphicon-star"></span></div>
                        <div class="device-name">Устройство <span ng-bind="item.device"></span></div>
                        <div class="service-name">Услуга <span ng-bind="item.service">Замена экрана</span></div>
                        <div class="service-name" ng-bind="dateBind(item.created_at) | date: 'dd-MM-yyyy'"></div>
                    </div>
                    <div class="col-sm-6">
                        <p ng-bind="item.text"></p>
                        <div class="info-comment" ng-if="item.is_phone == '1'">Отзыв зафиксирован со слов клиента по телефону</div>
                    </div>
                    <div class="col-sm-3">
                        <img class="avatar" src="{{ asset('site/img/logo_user_default.png') }}" align="left"/>
                        <h4 class="name" ng-bind="item.user_name"></h4>
                        <span class="date" ng-bind="item.date"></span>
                        <hr>
                        <div class="rating-details">

                            <div><span>Качество работ</span>
                                <rating value="item.r_quality_of_work" max="5"></rating>
                            </div>
                            <div><span>Соблюдение сроков</span>
                                <rating value="item.r_deadlines" max="5"></rating>
                            </div>
                            <div><span>Соблюдение стоимости</span>
                                <rating value="item.r_compliance_cost" max="5"></rating>
                            </div>
                            <div><span>Цена/качество</span>
                                <rating value="item.r_price_quality" max="5"></rating>
                            </div>
                            <div><span>Обслуживание</span>
                                <rating value="item.r_service" max="5"></rating>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=======================================END COMMENT ITEM=======================================-->
            </div>

        </div>
    </div>

@endsection
