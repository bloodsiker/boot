@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Заявки на помощь в подборе </li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-envelope-o" aria-hidden="true"></i>  Заявки на помощь</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="70">ID</th>
                                    <th>Имя</th>
                                    <th>Телефон</th>
                                    <th>Комментарий</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
                                    <th width="70"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allRequests as $requestH)
                                    <tr>
                                        <td>{{ $requestH->id }}</td>
                                        <td>{{ $requestH->user_name }}</td>
                                        <td>{{ $requestH->phone }}</td>
                                        <td>{{ $requestH->comment }}</td>
                                        <td class="status-request {{ \App\Models\UserRequest::colorStatusHelpRequest($requestH->status) }}">{{ $requestH->status }}</td>
                                        <td>{{ $requestH->created_at }}</td>
                                        <td class="text-center"><a href="{{ route('cabinet.admin.help-request', ['id' => $requestH->id]) }}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
