@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            User edit
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">

                @include('admin.includes.message-block')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Редактировать данные пользователя</h3>
                    </div>

                    <form action="/admin-panel/user/edit/{{ $user->id }}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Роль</label>
                                <select class="form-control" name="role_id">
                                    <option {{($user->role_id == 1) ? 'selected' : ''}}  value="1">Администратор</option>
                                    <option {{($user->role_id == 2) ? 'selected' : ''}} value="2">Сервисный центр</option>
                                    <option {{($user->role_id == 4) ? 'selected' : ''}} value="4">SEO</option>
                                    <option {{($user->role_id == 5) ? 'selected' : ''}} value="5">Оператор GS</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Имя">
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Email">
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group pull-right" role="group" aria-label="...">
                                <a href="{{ route('admin.users') }}" class="btn btn-default">Назад</a>
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>

@endsection