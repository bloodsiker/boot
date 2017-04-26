@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Users
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">

                @include('admin.includes.message-block')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Таблица пользователей</h3>
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Добавить</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Роль</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Дата создания</th>
                                <th width="50px"></th>
                                <th width="50px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->role->role_name }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td style="text-align: center;"><a href="/admin-panel/user/edit/{{ $user->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td style="text-align: center;"><a href="/admin-panel/delete/{{ $user->id }}" onclick="return confirm('Вы уверены что хотите удалить пользователя?') ? true : false;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Роль</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Дата создания</th>
                                <th></th>
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