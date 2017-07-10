@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-sign-in">
                <div class="login-box-sc">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-12 error">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('user.registration') }}" method="post" class="">
                        <h4>Регистрация пользователя</h4>
                        {{ csrf_field() }}
                        <label>
                            Имя:
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required/>
                        </label>
                        <label>
                            Email:
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}" required/>
                        </label>
                        <label>
                            Пароль:
                            <input type="password" name="password" class="form-control" required/>
                        </label>
                        <button class="btn btn-warning">Зарегистрироваться</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection