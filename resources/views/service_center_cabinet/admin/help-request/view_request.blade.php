@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="{{ route('cabinet.admin.help-requests') }}"> Заявки на помощь в подборе </a></li>
                <li class="active">Заявка </li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title pull-left"><i class="fa fa-navicon" aria-hidden="true"></i>  Детали заявки</h3>
                            <h3 class="box-title pull-right">{{ $requestInfo->status }}</h3>
                        </div>
                        <div class="box-body">

                            <table class="table table-bordered table-striped">
                                <thead>

                                </thead>
                                <tbody>
                                <tr>
                                    <td>Имя клиента</td>
                                    <td>{{ $requestInfo->user_name }}</td>
                                </tr>
                                <tr>
                                    <td>Телефон</td>
                                    <td>{{ $requestInfo->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Комментарий клиента</td>
                                    <td>{{ $requestInfo->comment }}</td>
                                </tr>
                                <tr>
                                    <td>Комментарий оператора</td>
                                    <td>{{ $requestInfo->operator_comment }}</td>
                                </tr>
                                <tr>
                                    <td>Статус</td>
                                    <td>{{ $requestInfo->status }}</td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td>{{ $requestInfo->created_at}}</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-striped">
                                <thead></thead>
                                <tbody>
                                <tr>
                                    <td>
                                        @if($requestInfo->status == 'Новая' || $requestInfo->status == 'Не отвечает')
                                            <form action="{{ route('cabinet.admin.help-request.change_status', ['id' => $requestInfo->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status" value="Закрыта">
                                                <input type="hidden" name="id" value="{{ $requestInfo->id }}">
                                                <button class="btn btn-success" id="request-close">Закрыть</button>
                                            </form>
                                        @endif

                                    </td>
                                    <td>
                                        @if($requestInfo->status == 'Новая')
                                            <form action="{{ route('cabinet.admin.help-request.change_status', ['id' => $requestInfo->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status" value="Не отвечает">
                                                <input type="hidden" name="id" value="{{ $requestInfo->id }}">
                                                <input type="submit" class="btn btn-warning" value="Не отвечает">
                                            </form>
                                        @endif
                                    </td>
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
