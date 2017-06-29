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
                            <h3 class="box-title"><i class="fa fa-area-chart" aria-hidden="true"></i>  Просмотры по услугам</h3>
                        </div>
                        <div class="box-body">
                            <canvas flex id="line"
                                    class="chart chart-bar"
                                    chart-data="serviceDataChart"
                                    chart-labels="serviceSeriesChart"
                                    chart-series="serviceSeriesChart"
                                    chart-options="options"
                                    chart-dataset-override="datasetOverride">
                            </canvas>

                            <hr>

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



                <div class="col-sm-6" ng-repeat="(visit_key, visit) in visits track by $index">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-area-chart" aria-hidden="true"></i> @{{ $index }}  Статистика просмотров <b><u>@{{ visit_key }}</u></b></h3>
                        </div>
                        <div class="box-body">
                            <canvas
                                    ng-if="visit"
                                    class="chart chart-bar"
                                    chart-data="visitData(visit)"
                                    chart-labels="visitlabels(visit)"
                                    chart-series="visitlabels(visit)"
                                    chart-options="options"
                                    chart-dataset-override="datasetOverride">
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
