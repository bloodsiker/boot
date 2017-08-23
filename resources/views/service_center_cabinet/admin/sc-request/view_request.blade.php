@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="{{ route('cabinet.admin.sc-requests') }}"> Заявки сервисным центрам </a></li>
                <li class="active">Заявка </li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-7">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-envelope-o" aria-hidden="true"></i>  Заявка #{{ $requestInfo->r_id }} </h3>
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


                <div class="col-sm-7">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-info-circle" aria-hidden="true"></i>  Информация о сервисном центре </h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>

                                </thead>
                                <tbody>
                                <tr>
                                    <td>Сервисный центр</td>
                                    <td>{{ $requestInfo->service_center->service_name }}</td>
                                </tr>
                                <tr>
                                    <td>Город</td>
                                    <td>{{ $sc->city->city_name }}</td>
                                </tr>
                                <tr>
                                    <td>Адрес</td>
                                    <td>{{ $sc->address }}</td>
                                </tr>
                                <tr>
                                    <td>Район</td>
                                    <td>{{ empty($sc->district) ? '' : $sc->district->address }}</td>
                                </tr>
                                <tr>
                                    <td>Метро</td>
                                    <td>{{ empty($sc->metro) ? '' : $sc->metro->address  }}</td>
                                </tr>
                                <tr>
                                    <td>Телефоны</td>
                                    <td>
                                        <ul>
                                            @foreach($sc->service_phones as $phone)
                                                <li>{{ $phone->phone }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Emails</td>
                                    <td>
                                        <ul>
                                            @foreach($sc->service_emails as $email)
                                                <li>{{ $email->email }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Сайт</td>
                                    <td>{{ $sc->site  }}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-envelope-o" aria-hidden="true"></i> Диалог сервисного центра с клиентом</h3>
                        </div>
                        <div class="box-body">
                            <ul class="timeline timeline-inverse">

                                @foreach($requestInfo['messages'] as $message)
                                    @if($message->sys_info == 1)
                                        <li>
                                            @if(!empty($message->user_name))
                                                <i class="fa fa-user bg-blue"></i>
                                            @else
                                                <i class="fa fa-user bg-yellow"></i>
                                            @endif

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> {{ $message->created_at }}</span>

                                                @if(!empty($message->user_name))
                                                    <h3 class="timeline-header no-border"><b>{{ $message->user_name }}</b><small> Клиент </small> {{ $message->message }}</h3>
                                                @else
                                                    <h3 class="timeline-header no-border"><b>{{ $message->service_name }}</b><small> Сервисный центер </small> {{ $message->message }}</h3>
                                                @endif
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            @if(!empty($message->user_name))
                                                <i class="fa fa-comments bg-blue"></i>
                                            @else
                                                <i class="fa fa-comments bg-yellow"></i>
                                            @endif

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> {{ $message->created_at }}</span>


                                                @if(!empty($message->user_name))
                                                    <h3 class="timeline-header"><b>{{ $message->user_name }}</b> <small>Клиент</small></h3>
                                                @else
                                                    <h3 class="timeline-header"><b>{{ $message->service_name }} <small>Сервисный центер</small></b></h3>
                                                @endif

                                                <div class="timeline-body">
                                                    {{ $message->message }}
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                                    @if(count($requestInfo['messages']) > 0)
                                        <li>
                                            <i class="fa fa-clock-o bg-gray"></i>
                                        </li>
                                    @endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
