@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2 boot-registration__columns form-sign-in">
                <div class="row">

                    <div class="col-md-12 no-padding boot-registration__column">
                        <div class="login-box-sc">
                            @if(Session::has('message'))
                                <div class="row">
                                    <div class="col-md-12 error">
                                        {{ Session::get('message') }}
                                    </div>
                                </div>
                            @endif
                            <div style="text-align: center">
                                <h3>Восстановление доступа к личному кабинету</h3>
                            </div>

                            <form action="{{ route('user.password.send-email') }}" method="post" class="">
                                {{ csrf_field() }}
                                <label>
                                    Email:
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" required/>
                                </label>
                                <div>
                                    <div class="pull-left">Введите адрес почты, который вы указывали при регистрации, на этот адрес отправим ссылку для восстановления пароля. </div>
                                    <button class="btn btn-warning pull-right">Восстановить пароль</button>
                                </div>

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

@endsection