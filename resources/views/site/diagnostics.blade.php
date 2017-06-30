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
                <h1>Дигностика устройства</h1>
                <uib-tabset active="activeTab" justified="true">
                    <uib-tab index="0" disable="true">
                        <uib-tab-heading>
                            <div class="tab-head">
                                <span class="circle-index">1</span> <span class="span-index">Уточните тип вашего устройства</span>
                            </div>
                        </uib-tab-heading>
                        <div class="row" style="display: flex;align-items: flex-end;">
                            <div class="col-md-4 text-center select-type" ng-click="activeType = 'phone'">
                                <img class="phone-img" src="{{ asset('site/img/smartphone-call.svg') }}" alt="Диагностика телефона">
                                <br>
                                <span ng-class="{active : activeType === 'phone'}">Телефон</span>
                            </div>
                            <div class="col-md-4 text-center select-type" style="cursor:not-allowed ">
                                {{--ng-click="activeType = 'tab'"--}}
                                <img class="tablet-img" src="{{ asset('site/img/tablet.svg') }}" alt="Диагностика планшета">
                                <br>
                                <span ng-class="{active : activeType === 'tab'}">Планшет</span>
                            </div>
                            <div class="col-md-4 text-center select-type" style="cursor:not-allowed ">
                                {{--ng-click="activeType = 'laptop'"--}}
                                <img class="laptop-img" src="{{ asset('site/img/laptop.svg') }}" alt="Диагностика ноутбука">
                                <br>
                                <span ng-class="{active : activeType === 'laptop'}">Ноутбук</span>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="row ">
=======
                        <div class="row " style="margin-top: 30px;">
>>>>>>> e70a4f41c34b75a710b735b70caf22c5345f1cfd
                            <div class="col-md-12 text-right">
                                <button class="btn btn-yellow" ng-click="firstStepBtn(activeType)">
                                    Вперед <span class="glyphicon glyphicon-triangle-right"></span>
                                </button>
                            </div>
                        </div>
                    </uib-tab>
                    <uib-tab index="1" disable="true">
                        <uib-tab-heading>
                            <div class="tab-head">
                                <span class="circle-index">2</span> <span class="span-index">Определите возможные неполадки</span>
                            </div>
                        </uib-tab-heading>

                        <div class="row" style="display: flex;align-items: center;">
                            <div class="col-xs-4">
                                <h3>Знаю точно: </h3>
                                <div ng-if="problems_know" ng-repeat="problem_know in problems_know" style="margin-bottom: 2px;">
                                        <span class="check"
                                              ng-class="{active: problem_know_check === problem_know}"
                                              ng-click="getProblemWatching(activeType, problem_know)">@{{problem_know}}</span>
                                </div>

                            </div>
                            <div ng-if="problems_watching" class="col-xs-4">
                                <h3>Наблюдаю: </h3>

                                <div ng-repeat="problem_watching in problems_watching" style="margin-bottom: 2px;">
                                        <span class="check"
                                              ng-class="{active: problem_watching_check === problem_watching}"
                                              ng-click="setProblemWatching(activeType, problem_watching)">@{{problem_watching}}</span>
                                </div>

                            </div>
                            <div class="col-xs-4" ng-if="problem_know_check && problem_watching_check">
                                <h3>Описание дефекта: </h3>
                                <div ng-repeat="problem_description in problems_description" style="margin-bottom: 2px;">
                                    <span class="check"
                                          ng-class="{active: problem_description_check === problem_description}"
                                          ng-click="setProblemDescription(problem_description)">@{{problem_description}}</span>
                                </div>

                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="row ">
=======
                        <div class="row " style="margin-top: 30px;">
>>>>>>> e70a4f41c34b75a710b735b70caf22c5345f1cfd
                            <div class="col-md-12 text-right">
                                <button class="btn btn-yellow" style="margin-right: 20px;" ng-click="firstStepBtn(activeType); reload()">
                                    Сброс <span class="glyphicon glyphicon-repeat"></span>
                                </button>
                                <button class="btn btn-black" ng-click="prevPage(activeTab -1)">
                                    Назад <span class="glyphicon glyphicon-triangle-left"></span>
                                </button>
                                <button class="btn" ng-disabled="!problem_description_check"
                                        ng-class="{'btn-yellow': problem_description_check, 'btn-black': !problem_description_check}"
                                        ng-click="getProblemRezult(activeType, problem_know_check, problem_watching_check, problem_description_check)">
                                    Вперед <span class="glyphicon glyphicon-triangle-right" ></span>
                                </button>
                            </div>
                        </div>
                    </uib-tab>
                    <uib-tab index="2" disable="true">
                        <uib-tab-heading>
                            <div class="tab-head">
                                <span class="circle-index">3</span> <span class="span-index">Ознакомьтесь с предварительной стоимостью</span>
                            </div>
                        </uib-tab-heading>

                        <div class="row">

                            <div ng-if="results" class="col-xs-12">
                                <h3>Результат: </h3>
                                <table class="table">
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
                                        <tr ng-repeat="rez in results">
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

<<<<<<< HEAD
                        <div class="row ">
=======
                        <div class="row" style="margin-top: 30px;">
>>>>>>> e70a4f41c34b75a710b735b70caf22c5345f1cfd
                            <div class="col-md-12 text-right">
                                <button class="btn btn-black" ng-click="prevPage(activeTab -1)">
                                    Назад <span class="glyphicon glyphicon-triangle-left"></span>
                                </button>
                            </div>
                        </div>
                    </uib-tab>
                </uib-tabset>


            </div>
        </div>
    </div>

@endsection
