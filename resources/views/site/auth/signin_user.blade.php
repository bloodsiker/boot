@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1 form-sign-in">
                <div class="row">

                    <div class="col-md-6 no-padding">
                        <div class="login-box-sc">
                            <h2>Нет аккаунта?</h2>
                            <p>Присоединяйтесь к нам!</p>
                            <p>После регистрации у вас будет возможность отслеживать статусы выполнения выших заказов.</p>
                            <a href="{{ route('service.registration') }}" class="btn btn-warning">Зарегистрировать</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <div class="login-form-sc login-box-sc">
                            @if(Session::has('message'))
                                <div class="row">
                                    <div class="col-md-12 error">
                                        {{ Session::get('message') }}
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('service.login') }}" method="post" class="">
                                <h4>Вход</h4>
                                {{ csrf_field() }}
                                <label>
                                    Email:
                                    <input type="text" name="email" class="form-control" required/>
                                </label>
                                <label>
                                    Пароль:
                                    <input type="password" name="password" class="form-control" required/>
                                </label>
                                <button class="btn btn-warning">Вход</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection