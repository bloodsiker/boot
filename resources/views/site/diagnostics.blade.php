@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('og:image', asset('site/img/diagnostics.jpg'))

@section('controller', 'DiagnosticCtrl')


@section('content')

    <!--=======================================DIAGNOSTICS=======================================-->

    <div class="container">
        <div class="row">
            <div class="col-xs-12 diagnostics">
                <h1>Диагностика устройства</h1>

                <div style="margin-top: 50px; margin-bottom: 100px; min-height: 300px">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="about_defect">Описание дефекта: </label>
                                <select name="about_defect" id="about_defect" ng-model="problem_description_select" ng-change="getProblemRezult('desc')" class="form-control yellow-input" >
                                    <option ng-repeat="problem_description in problems_description track by $index" value="@{{ problem_description }}">@{{ problem_description }}</option>
                                </select>
                                <small class="text-danger" ng-if="!problem_description_select">Выберите описание дефекта</small>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="i_know">Знаю точно:</label>
                                <select name="i_know" id="diagnostic_i_know" class="form-control" ng-model="problem_know_select" ng-change="getProblemRezult('know')">
                                    <option ng-repeat="problem_know in problems_know track by $index" value="@{{ problem_know }}">@{{ problem_know }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="i_watching">Наблюдаю: </label>
                                <select name="i_watching" id="i_watching" class="form-control" ng-model="problem_watching_select" ng-change="getProblemRezult('watch')">
                                    <option ng-repeat="problem_watching in problems_watching track by $index" value="@{{ problem_watching }}">@{{ problem_watching }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <button class="btn btn-yellow" style="margin-top: 25px;" ng-click="firstStep()">Cбросить</button>
                        </div>
                    </div>
                    <div class="row">
                        <div ng-if="!results" class="col-xs-12">
                            <h3 style="color: #999999;">Не выбранные критерии диагностки</h3>
                        </div>
                        <div ng-if="results" class="col-xs-12">
                            <h3>Ознакомьтесь с предварительной стоимостью: </h3>
                            <table class="table" style="margin-top: 50px;">
                                <thead>
                                <tr>
                                    <th>Нужная запчасть</th>
                                    <th>Вероятность поломки</th>
                                    <th>Нужная услуга</th>
                                    <th>Минимальная цена</th>
                                    <th>Максимальная цена</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="rez in results track by $index">
                                    <td ng-bind="rez.spare_part"></td>
                                    <td ng-bind="rez.percentage"></td>
                                    <td ng-bind="rez.services"></td>
                                    <td ng-bind="rez.min_price ? rez.min_price : '-'"></td>
                                    <td ng-bind="rez.max_price ? rez.max_price : '-'"></td>
                                    <td>
                                        <button style="font-size: 14px;"
                                                class="btn btn-yellow btn-sm"
                                                ng-click="searchService(rez)">
                                            <span class="glyphicon glyphicon-search"></span>
                                            Подобрать сервисный центр
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
