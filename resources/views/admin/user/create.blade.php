@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            User create
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">

                @include('admin.includes.message-block')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Добавить нового пользователя</h3>
                    </div>

                    <form action="{{ route('admin.user.create') }}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Роль</label>
                                <select class="form-control" name="role_id">
                                    <option value="1">Администратор</option>
                                    <option value="2">Сервисный центр</option>
                                    <option value="4">SEO</option>
                                    <option value="5">Оператор GS</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ Request::old('name') }}" placeholder="Имя">
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ Request::old('email') }}" placeholder="Email">
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group pull-right" role="group" aria-label="...">
                                <a href="{{ route('admin.users') }}" class="btn btn-default">Назад</a>
                                <button type="submit" class="btn btn-primary pull-right">Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>

@endsection