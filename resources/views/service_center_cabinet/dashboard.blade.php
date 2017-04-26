@extends('service_center_cabinet.layouts.master')


@section('content')

    <div layout-padding ng-controller="AdminDashboardController" layout="column">
        <div flex layout-margin layout="row">
            <div flex>
                <canvas flex id="line" class="chart chart-line" chart-data="data[0]"
                        chart-labels="labels" chart-series="series" chart-options="options"
                        chart-dataset-override="datasetOverride" chart-click="onClick">
                </canvas>
            </div>
            <md-divider></md-divider>
            <div flex>
                <canvas id="line" class="chart chart-line" chart-data="data"
                        chart-labels="labels" chart-series="series" chart-options="options"
                        chart-dataset-override="datasetOverride" chart-click="onClick">
                </canvas>
            </div>
            <table>
                <thead>
                <tr>
                    <th ng-repeat="item in labels">@{{ item }}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td ng-repeat="item in data[0]">@{{ item }}</td>
                </tr>
                <tr>
                    <td ng-repeat="item in data[1]">@{{ item }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div layout-margin flex layout="row">
            <div flex>
                <canvas class="chart chart-bubble" chart-data="data1"
                        chart-colors="colors1" chart-options="options1"></canvas>
            </div>
            <md-calendar ng-model="ddd"></md-calendar>


        </div>

    </div>

@endsection
