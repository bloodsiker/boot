@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')

    <div class="container">
        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-12 error">
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <form action="{{ route('service.login') }}" method="post" class="form-sign-in">
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

@endsection