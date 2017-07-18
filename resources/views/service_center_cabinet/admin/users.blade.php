@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Пользователи</li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i>  Пользователи</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Имя</th>
                                    <th>Дата регистранции</th>
                                    <th>Последнее посещение</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_user as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->last_online }}</td>
                                        <td class="text-center"><a href="{{ route('cabinet.admin.user.list.sc', ['id' => $user->id]) }}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
