@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="{{ route('service.registration') }}" method="post" class="form-sign-in">
                    <h4>Регистрация</h4>
                    {{ csrf_field() }}
                    <label>
                        Имя:
                        <input type="text" name="name" class="form-control" required/>
                    </label>
                    <label>
                        Email:
                        <input type="text" name="email" class="form-control" required/>
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

@endsection