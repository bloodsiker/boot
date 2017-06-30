@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="AdminDashboardController" ng-cloak>
        <section class="content-header">
            <h1 ng-bind="sc.service_name"></h1>
            <ol class="breadcrumb">
                <li><a href="/cabinet/dashboard"><i class="fa fa-dashboard"></i> Главная</a></li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-area-chart" aria-hidden="true"></i>  Популярные услуги сайта</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <canvas flex id="line"
                                            class="chart chart-bar"
                                            chart-data="serviceDataChart"
                                            chart-labels="serviceSeriesChart"
                                            chart-series="serviceSeriesChart"
                                            chart-options="options"
                                            chart-dataset-override="datasetOverride">
                                    </canvas>
                                </div>
                                <div class="col-sm-7">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Услуга</td>
                                            <td>Кол-во просмотров</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="item in top_services">
                                            <td ng-bind="item.services"></td>
                                            <td ng-bind="item.view"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" ng-repeat="(visit_key, visit) in visits track by $index">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-area-chart" aria-hidden="true"></i>Статистика просмотров <b><u>@{{ visit_key }}</u></b></h3>
                        </div>
                        <div class="box-body">
                            <canvas
                                    ng-if="visit"
                                    class="chart chart-bar"
                                    chart-data="data"
                                    chart-labels="labels"
                                    chart-series="series"
                                    chart-options="options">
                            </canvas>

                            <hr>

                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Дата</td>
                                    <td>Кол-во просмотров</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="item in visit">
                                    <td ng-bind="item.date_view"></td>
                                    <td ng-bind="item.views"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
