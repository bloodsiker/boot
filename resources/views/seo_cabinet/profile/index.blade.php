@extends('seo_cabinet.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Profile
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-5">
                @include('admin.includes.message-block')

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Данные юзера</h3>
                    </div>

                    <form action="{{ route('seo.profile.update') }}" method="post" role="form">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" placeholder="Имя">
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" placeholder="Email">
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group pull-right" role="group" aria-label="...">
                                <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Изменить пароль</h3>
                    </div>

                    <form action="{{ route('seo.profile.update') }}" method="post" role="form">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Текущий пароль</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ Request::old('name') }}" placeholder="Имя">
                            </div>
                            <div class="form-group">
                                <label for="email">Новый пароль</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ Request::old('email') }}" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Повторите новый пароль</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group pull-right" role="group" aria-label="...">
                                <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>

@endsection