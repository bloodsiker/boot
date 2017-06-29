@extends('service_center_cabinet.layouts.master')

@section('content')


    <section class="content-header">
        <h1>
            Добавить сервисный центр
        </h1>
        <ol class="breadcrumb">
            <li><a href="/cabinet/dashboard"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Добавить сервисный центр</li>
        </ol>
    </section>

    <section class="content" ng-controller="AddScController">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary" >
                <div class="box-header with-border">
                    <h3 class="box-title">Главная информация</h3>
                </div>

                <form role="form" name="addForm" novalidate>
                    <div class="box-body">


                        <div class="form-group">
                            <label>Название сервисного центра</label>
                            <input type="text" ng-model="sc.name" class="form-control" placeholder="Название сервисного центра" required>
                        </div>


                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Город</label>
                                    <select class="form-control" ng-model="sc.city" ng-options="city.city_name for city in cities track by city.id" required></select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Район</label>
                                    <select class="form-control" ng-model="sc.district" ng-options="district.address for district in districts track by district.id"></select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group drop-street">
                                    <label>Улица</label>

                                    <input type="text"
                                           class="form-control"
                                           typeahead-on-select="selectedStreet($item)"
                                           typeahead-show-hint="true"
                                           typeahead-min-length="0"
                                           placeholder="Искать улицу"
                                           ng-model="street.address"
                                           required
                                           uib-typeahead="street as street.address for street in streets | filter:$viewValue | limitTo: 30">

                                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Номер</label>
                                    <input type="text" class="form-control" ng-change="changeNumberH($event)" ng-model="sc.number_h" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Метро</label>
                                    <select class="form-control" ng-model="sc.metro" ng-options="metro.address for metro in metros track by metro.id"></select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Дополнительная информация (ТЦ Большевик, 2 этаж)</label>
                                    <input type="text" class="form-control" ng-model="sc.number_h_add">
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="box-footer text-right">
                        <button type="button" class="btn btn-primary" ng-click="addSc(addForm.$valid, sc)">Добавить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <ng-map id="map" center="@{{sc.c1}}, @{{sc.c2}}" zoom="14">
                <marker position="@{{sc.c1}}, @{{sc.c2}}"
                        cursor="default"
                        icon="{url:'/site/img/marker-map.png'}">

                </marker>
            </ng-map>
        </div>


    </div>


</section>




@endsection
