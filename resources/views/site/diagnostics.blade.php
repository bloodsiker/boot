@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'DiagnosticCtrl')


@section('content')

    <!--=======================================DIAGNOSTICS=======================================-->

    <div class="container">
        <div class="row">
            <div class="col-xs-12 diagnostics">
                <div class="row diagnostics-header">
                    <div class="col-md-4">
                        <div class="step" ng-class="{active: step == 'step_1'}">
                            <div class="step-count">1</div><span class="line">|</span><div class="title-step">Уточните тип <br> вашего устройства</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step" ng-class="{active: step == 'step_2'}">
                            <div class="step-count">2</div><span class="line">|</span><div class="title-step">Определите <br> возможные неполадки</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step" ng-class="{active: step == 'step_3'}">
                            <div class="step-count">3</div><span class="line">|</span><div class="title-step">Ознакомьтесь с <br> предварительной стоимостью</div>
                        </div>
                    </div>
                </div>
                <div class="row diagnostics-body">

                    <!--STEP1-->
                    <div ng-if="step == 'step_1'" class="col-md-3 col-md-offset-2">
                        <h3>Выберите тип устройства:</h3>
                        <div class="radio">
                            <label><input type="radio" name="type">Смартфон</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="type">Планшет</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="type">Ноутбук</label>
                        </div>
                    </div>

                    <div class="col-md-12" ng-if="step == 'step_2'">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-2">
                                <h3>Наблюдаю:</h3>
                                <div class="radio" ng-repeat="item in watching">
                                    <label><input type="radio" value="item.id" name="watching">@{{item.title}}</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-md-offset-1 slide-left">
                                <h3>Знаю точно:</h3>
                                <div class="radio" ng-repeat="item in know">
                                    <label><input type="radio" value="item.id" name="know">@{{item.title}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--STEP2-->

                    <div class="col-md-12" ng-if="step == 'step_3'">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Описание дефекта</th>
                                            <th>Нужная З/Ч</th>
                                            <th>% вероятности поломки</th>
                                            <th>Решение</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in result">
                                            <td>@{{item.val0}}</td>
                                            <td>@{{item.val1}}</td>
                                            <td>@{{item.val2}}</td>
                                            <td>@{{item.val3}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--STEP3-->


                </div>
                <div class="row diagnostics-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button ng-if="step == 'step_2' || step == 'step_3'" class="btn btn-warning" ng-click="step_prev_btn()">Назад <span class="glyphicon glyphicon-arrow-left"></span></button>
                        </div>
                        <div class="col-md-6">
                            <button ng-if="step != 'step_3'" class="btn btn-warning" ng-click="step_next_btn()">Вперед <span class="glyphicon glyphicon-arrow-right"></span></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
