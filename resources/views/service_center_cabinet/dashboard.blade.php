@extends('service_center_cabinet.layouts.master')


@section('content')

    <div layout-padding ng-controller="AdminDashboardController" layout="column">
        <div flex layout-margin layout="column">
            <div flex>
                <canvas flex id="line"
                        class="chart chart-bar"
                        chart-data="data[0]"
                        chart-labels="labels"
                        chart-series="series"
                        chart-options="options"
                        chart-dataset-override="datasetOverride"
                       >
                </canvas>
            </div>


            <div flex layout="row">
                    <div layout-margin>
                        <h3 class="md-title">Просмотры по услугам</h3>
                        <table>
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

                <div layout-margin>
                    <h3 class="md-title">Просмотры по услугам</h3>
                    <table>
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

@endsection
