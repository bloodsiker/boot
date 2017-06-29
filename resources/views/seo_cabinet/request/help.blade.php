@extends('seo_cabinet.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Pages
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список заявок для подбора сервисного центра</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Страница</th>
                                <th>Город</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Комментарий</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th width="50px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $req)
                                <tr data-id="{{ $req->id }}">
                                    <td>{{ $req->id }}</td>
                                    <td>{{ $req->pagename }}</td>
                                    <td>{{ $req->city }}</td>
                                    <td>{{ $req->name }}</td>
                                    <td>{{ $req->phone }}</td>
                                    <td>{{ $req->comment }}</td>
                                    <td>{{ $req->status }}</td>
                                    <td>{{ $req->created_at->format('d.m.Y H:i') }}</td>
                                    <td><button class="btn btn-success btn-xs edit-request"><i class="fa fa-edit"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Сервисный центр</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Комментарий</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
    </section>

@endsection