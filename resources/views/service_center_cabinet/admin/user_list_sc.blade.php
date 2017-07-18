@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-users"></i> Пользователи</a></li>
                <li class="active">Сервисные центры</li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Сервисные центры</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="70">ID</th>
                                    <th width="150">Logo</th>
                                    <th>Название</th>
                                    <th>Статус</th>
                                    <th>Верификация</th>
                                    <th width="70"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_user_sc as $sc)
                                    <tr>
                                        <td>{{ $sc->id}}</td>
                                        <td><img src="{{ $sc->logo }}" width="150" alt=""></td>
                                        <td>{{ $sc->service_name }}</td>
                                        <td>{{ $sc->enabled == 0 ? '' : 'Удален' }}</td>
                                        <td>{{ $sc->verified == 0 ? '' : 'Верифицирован' }}</td>
                                        <td class="text-center"><a href="{{ route('cabinet.admin.service', ['id' => $sc->id]) }}"><i class="fa fa-eye"></i></a></td>
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
