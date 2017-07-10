@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')


    <div class="container user_profile">

        <div class="row">
            <div class="col-sm-3">

                @include('user_profile.includes.sidebar')

            </div>
            <div class="col-sm-9">

                <div class="panel rounded shadow panel-teal">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">Настройки</h3>
                        </div>
                        <div class="pull-right">
                            <form action="#" class="form-horizontal mr-5 mt-3">
                                <div class="form-group no-margin no-padding has-feedback">

                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding"  style="margin-top: 15px">

                        @include('user_profile.includes.message-block')

                        <section class="comment-list">

                            <form class="form-horizontal" action="{{ route('user.setting') }}" method="POST">
                                <fieldset>
                                    {{ csrf_field() }}

                                    @if(!empty(Auth::user()->password))

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="old_password">Текущий пароль</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-key">
                                                        </i>
                                                    </div>
                                                    <input id="old_password" name="old_password" type="text"
                                                           placeholder="Текущий пароль"
                                                           required
                                                           class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="password">Новый пароль</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-key">
                                                    </i>
                                                </div>
                                                <input id="password" name="password" type="text"
                                                       placeholder="Новый пароль"
                                                       required
                                                       class="form-control input-md">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="password_confrim">Повторите новый пароль</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-key">
                                                    </i>
                                                </div>
                                                <input id="password_confrim" name="password_confrim" type="text"
                                                       placeholder="Повторите новый пароль"
                                                       required
                                                       class="form-control input-md">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-6">
                                            @if(!empty(Auth::user()->password))
                                                <button class="btn btn-success"><i class="fa fa-cog  fa-spin fa-fw" aria-hidden="true"></i> Установить пароль</button>
                                            @else
                                                <button class="btn btn-success"><i class="fa fa-cog  fa-spin fa-fw" aria-hidden="true"></i> Изменить пароль</button>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                        </section>



                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

            </div>
        </div>
    </div>

@endsection