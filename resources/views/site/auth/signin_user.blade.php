@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1 boot-registration__columns form-sign-in">
                <div class="row">

                    <div class="col-md-6 no-padding boot-registration__column">
                        <div class="login-box-sc">
                            @if(Session::has('message'))
                                <div class="row">
                                    <div class="col-md-12 error">
                                        {{ Session::get('message') }}
                                    </div>
                                </div>
                            @endif
                            <div style="text-align: center">
                                <h3>Войти</h3>
                                <a href="{{ route('auth.facebook') }}" class="btn btn-primary btn-block">facebook</a>
                                <div class="form-separator">
                                    <span class="form-separator-text">или заполните форму</span>
                                </div>
                            </div>

                            <form action="{{ route('user.login') }}" method="post" class="">
                                {{ csrf_field() }}
                                <label>
                                    Email:
                                    <input type="text" name="email" class="form-control" required/>
                                </label>
                                <label>
                                    Пароль:
                                    <input type="password" name="password" class="form-control" required/>
                                </label>
                                <button class="btn btn-warning pull-right">Вход</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding boot-registration__column">
                        <div class="login-box-sc login-form-sc" style="min-height: 413px; padding-top: 50px">
                            <h2>Нет аккаунта?</h2>
                            <p>Присоединяйтесь к нам!</p>
                            <p>После регистрации у вас будет возможность отслеживать статусы выполнения выших заказов.</p>
                            <p>Вести диалог с сервисным центром по конкретном заказе</p>
                            <p>Добавлять понравившиеся сервисные центры в избранные</p>
                            <br>
                            <a href="{{ route('user.registration') }}" class="btn btn-warning pull-right">Зарегистрировать</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection