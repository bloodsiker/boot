@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="{{ route('cabinet.messages') }}"> Заявки </a></li>
                <li class="active">Заявка </li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-7">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-envelope-o" aria-hidden="true"></i>  Заявка #{{ $requestInfo->id }} </h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Статус</td>
                                        <td class="status-request {{ \App\Models\FormRequest::colorStatusScRequest($requestInfo->status_id) }}">{{ $requestInfo->status->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Город</td>
                                        <td>{{ $requestInfo->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>Имя клиента</td>
                                        <td>{{ $requestInfo->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Телефон клиента</td>
                                        <td>{{ $requestInfo->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email клиента</td>
                                        <td>{{ $requestInfo->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Адрес клиента</td>
                                        <td>{{ $requestInfo->client_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Комментарий клиента</td>
                                        <td>{{ $requestInfo->task_description }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title pull-left"><i class="fa fa-navicon" aria-hidden="true"></i>  Детали заявки</h3>
                        </div>
                        <div class="box-body">

                            <table class="table table-bordered table-striped">
                                <thead>

                                </thead>
                                <tbody>
                                <tr>
                                    <td>Производитель</td>
                                    <td>{{ $requestInfo->manufacturer }}</td>
                                </tr>
                                <tr>
                                    <td>Услуга</td>
                                    <td>{{ $requestInfo->services }}</td>
                                </tr>
                                <tr>
                                    <td>Приблизительная стоимость</td>
                                    <td>{{ $requestInfo->cost_of_work_min }} - {{ $requestInfo-> cost_of_work_max}}</td>
                                </tr>
                                <tr>
                                    <td>Окончательная стоимость</td>
                                    <td>{{ $requestInfo->cost_of_work_end }}</td>
                                </tr>
                                <tr>
                                    <td>Способ оплаты</td>
                                    <td>{{ $requestInfo->payment_method }}</td>
                                </tr>
                                <tr>
                                    <td>Выезд мастера</td>
                                    <td>{{ $requestInfo->exit_master == 1 ? 'Да' : 'Нет' }}</td>
                                </tr>
                                <tr>
                                    <td>Приблизительная дата завершение ремонта</td>
                                    <td>{{ $requestInfo->deadline }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-striped">
                                <thead></thead>
                                <tbody>
                                <tr>
                                    <td>
                                        @if($requestInfo->status_id == 1)
                                            <form action="{{ route('cabinet.admin.sc-request.change_status', ['id' => $requestInfo->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status_id" value="5">
                                                <input type="hidden" name="id" value="{{ $requestInfo->id }}">
                                                <button class="btn btn-success">В обработке</button>
                                            </form>
                                        @endif

                                    </td>
                                    <td>
                                        @if($requestInfo->status_id == 1)
                                            <form action="{{ route('cabinet.admin.sc-request.change_status', ['id' => $requestInfo->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status_id" value="3">
                                                <input type="hidden" name="id" value="{{ $requestInfo->id }}">
                                                <input type="submit" class="btn btn-danger" id="request-reject" value="Отклонить">
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
