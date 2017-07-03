@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="MessagesCtrl" ng-cloak>
        <section class="content-header">
            <h1>
                Mailbox
            </h1>
            <ol class="breadcrumb">
                <li><a href="/cabinet/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Заявки</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Папки</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li ng-class="{active: activeFilter == ''}"><a href ng-click="filterMessages('all','')"><i class="fa fa-inbox"></i> Все</a></li>
                                <li ng-class="{active: activeFilter == 1}"><a href ng-click="filterMessages('status_id',1)"><i class="fa fa-filter"></i>Ожидают подтверждения </a>
                                <li ng-class="{active: activeFilter == 2}"><a href ng-click="filterMessages('status_id',2)"><i class="fa fa-clock-o" aria-hidden="true"></i> В работе </a></li>
                                <li ng-class="{active: activeFilter == 4}"><a href ng-click="filterMessages('status_id',4)"><i class="fa fa-check" aria-hidden="true"></i> Ожидают закрытия </a></li>
                                <li ng-class="{active: activeFilter == 6}"><a href ng-click="filterMessages('status_id',6)"><i class="fa fa-check" aria-hidden="true"></i> Закрытые </a></li>
                                <li ng-class="{active: activeFilter == 3}"><a href ng-click="filterMessages('status_id',3)"><i class="fa fa-remove"></i> Отклоненные </a></li>
                                <li ng-class="{active: activeFilter == 'stars'}"><a href ng-click="filterMessages('favorite','1')"><i class="fa fa-star text-yellow"></i> Помеченные </a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Заявки</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="mailbox-controls text-right">
                                <div>
                                    Всего: <b>@{{ messages.length }}</b> заявок
                                </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    <tr ng-repeat="message in messages | filter: activeFilterObject | limitTo: limitMessages as filteredMessages">
                                        <td class="mailbox-star"><a href ng-click="updateMessage(message, 'favorite')">
                                                <i ng-if="message.favorite == '0'" class="fa fa-star-o text-yellow"></i>
                                                <i ng-if="message.favorite == '1'" class="fa fa-star text-yellow"></i>
                                            </a></td>
                                        <td class="mailbox-name"><a href ng-click="openMessage(message.id)" ng-bind="message.name"></a></td>
                                        <td class="mailbox-subject"><b ng-bind="message.status.status"></b> - @{{message.services}}
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date" ng-bind="message.created_at"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div>
                                    <button type="button" ng-if="limitMessages <= messages.length" ng-click="addLimitMessages()" class="btn btn-default btn-sm">Показать еще</button>
                                    <div class="pull-right">
                                        Всего: <b>@{{ messages.length }}</b> заявок
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script type="text/ng-template" id="readMessage.html">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Заявка </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>@{{ message.services }} <span class="mailbox-read-time pull-right">@{{ message.updated_at }}</span></h3>
                            <h5>От: @{{ message.name }}<span class="mailbox-read-time pull-right">@{{ message.email }}</span></h5>
                            <h5>Телефон: @{{ message.phone }}</h5>
                            <h5>Оплата: <strong>@{{ message.cost_of_work_min }}грн</strong>  — <strong>@{{ message.cost_of_work_max }}грн</strong> <span class="mailbox-read-time pull-right">@{{ message.payment_method }}</span></h5>
                            <h5>По адресу: @{{ message.service_center.address }}</h5>
                            <h5 ng-if="message.deadline">Приблизительная дата выполнения работы: @{{ message.deadline }}</h5>
                            <h5 ng-if="message.exit_master ===  '1'">Адрес клиента: @{{ message.client_address }}<span class="pull-right"><b class="fa fa-exclamation-triangle"></b> Выезд мастера</span></h5>

                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message" ng-bind="message.task_description"></div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer"  ng-if="message.status_id === '1' || message.status_id === '2'">
                        <div class="input-group">
                            <label for="deadline">Приблизительная дата выполнения работы</label>
                            <input type="text" class="form-control"
                                   uib-datepicker-popup="@{{format}}"
                                   ng-model="dt"
                                   id="deadline"
                                   is-open="calendar.opened"
                                   datepicker-options="dateOptions"
                                   ng-required="true" />
                            <span class="input-group-btn"  style="vertical-align: bottom;">
                                    <button type="button" class="btn btn-default" ng-click="calendarOpen()"><i class="glyphicon glyphicon-calendar"></i></button>
                                </span>
                        </div>
                    </div>
                    <div class="box-footer"  ng-if="message.status_id === '1' || message.status_id === '2'">
                        <div class="pull-right">
                            <button ng-if="message.status_id === '1'" type="button" class="btn btn-default"><i class="fa fa-remove"></i> Отклонить</button>
                            <button ng-if="message.status_id === '1'" type="button" class="btn btn-success"><i class="fa fa-check"></i> Принять</button>
                            <button ng-if="message.status_id === '2'" type="button" class="btn btn-success"><i class="fa fa-check"></i> Выполнить</button>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
        </div>
    </script>


@endsection
