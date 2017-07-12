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
                            <h3 class="panel-title">Информация о пользователе</h3>
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

                        <div class="row">

                            @include('user_profile.includes.message-block')

                            <div class="col-sm-9">
                                <section class="comment-list">

                                    <form class="form-horizontal" action="{{ route('user.profile') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="name">Имя</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user">
                                                            </i>
                                                        </div>
                                                        <input id="name" name="name" type="text"
                                                               placeholder="Имя"
                                                               value="{{ Auth::user()->name }}"
                                                               class="form-control input-md">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- File Button -->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="avatar">Аватар</label>
                                                <div class="col-md-6">
                                                    <input id="avatar" name="avatar" class="input-file"
                                                           type="file">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="address">Адрес</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-street-view"></i>
                                                        </div>
                                                        <input id="address"
                                                               name="address"
                                                               type="text"
                                                               placeholder="Адрес"
                                                               value="{{ Auth::user()->address }}"
                                                               class="form-control input-md">
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="phone">Телефон</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-phone"></i>

                                                        </div>
                                                        <input id="phone" name="phone" type="text"
                                                               placeholder="Телефон"
                                                               value="{{ Auth::user()->phone }}"
                                                               class="form-control input-md">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="email">Email</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope-o"></i>

                                                        </div>
                                                        <input id="email" name="email" type="text"
                                                               placeholder="Email"
                                                               value="{{ Auth::user()->email }}"
                                                               disabled
                                                               class="form-control input-md">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Textarea -->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="about_me">О себе</label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control" rows="4"
                                                              id="about_me"
                                                              name="about_me">{{ Auth::user()->about_me }}</textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-4 control-label"></label>
                                                <div class="col-md-6">
                                                    <button class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Обновить профиль</button>
                                                </div>
                                            </div>

                                        </fieldset>
                                    </form>
                                </section>
                            </div>

                            <div class="col-md-2 hidden-xs">
                                <img src="{{ !empty(Auth::user()->avatar) ? Auth::user()->avatar : 'http://websamplenow.com/30/userprofile/images/avatar.jpg' }}"
                                     class="img-responsive img-thumbnail">
                            </div>
                        </div>

                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

            </div>
        </div>
    </div>

@endsection