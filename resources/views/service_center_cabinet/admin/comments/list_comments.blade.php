@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Комментарии</li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-comments" aria-hidden="true"></i>  Комментарии</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="70">ID</th>
                                    <th width="150"></th>
                                    <th>Сервисный центр</th>
                                    <th>Средняя оценка</th>
                                    <th>Комментарий</th>
                                    <th>Статус</th>
                                    <th width="70"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td><img src="{{ $comment->service_center['logo'] }}" width="150" alt=""></td>
                                        <td><a href="{{ route('sc', ['id' => $comment->service_center_id]) }}" target="_blank">{{ $comment->service_center['service_name'] }}</a></td>
                                        <td>{{ $comment->r_total_rating }}</td>
                                        <td>{{ $comment->text }}</td>
                                        <td>{{ $comment->status == 0 ? 'Не опубликован' : 'Опубликован' }}</td>
                                        <td class="text-center"><a href="{{ route('cabinet.admin.comment', ['id' => $comment->id]) }}"><i class="fa fa-eye"></i></a></td>
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
