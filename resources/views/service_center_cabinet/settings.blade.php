@extends('service_center_cabinet.layouts.master')

@section('content')

    <section class="content-header">
        <h1>Профиль</h1>
        <ol class="breadcrumb">
            <li><a href="/cabinet/dashboard"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Профиль</li>
        </ol>
    </section>

    <section class="content">

            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 success">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <form name="settingForm" action="{{ route('cabinet.settings') }}" method="post" ng-submit="addSettingsIndex($event, settingForm.$valid, settings)" novalidate>

                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-calendar" aria-hidden="true"></i>  Основные настойки</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-md-12" >
                                    @if(Auth::user()->change_email == 0)
                                        <div>Email можно изменить только один раз!</div>
                                    @else
                                        <div>Вы уже изменяли email, повторное изменение не доступно!</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" ng-disabled="{{ Auth::user()->change_email }}" name="email" ng-init="settings.email='{{ Auth::user()->email}}'" ng-model="settings.email" required>
                                        <div ng-messages="settingForm.email.$error">
                                            <div ng-message="required">Это поле обязательное для ввода.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" >
                                    <div class="input-group">
                                        <label>Имя</label>
                                        <input type="text" class="form-control"  name="name" ng-init="settings.name='{{ Auth::user()->name}}'" ng-model="settings.name" required>
                                        <div ng-messages="settingForm.name.$error">
                                            <div ng-message="required">Это поле обязательное для ввода.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer text-right" >
                            <button type="submit"  class="btn btn-primary">Сохранить</button>
                        </div>

                    </div>
                    </form>
                </div>



                <div class="col-sm-6">
                    <form name="settingFormPass" action="{{ route('cabinet.settings') }}" method="post" ng-submit="addSettingsPass($event, settingFormPass.$valid, settings)" novalidate>

                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-calendar" aria-hidden="true"></i>  Изменить пароль</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-md-12" >
                                    <div class="input-group">
                                        <label>Пароль</label>
                                        <input type="password" class="form-control" name="passFirst" ng-model="settings.passFirst" required>
                                    </div>
                                    <div class="input-group">
                                        <label>Подтвердите пароль</label>
                                        <input type="password" class="form-control" name="passLast" ng-model="settings.passLast" required>
                                        <div ng-if="settings.passFirst != settings.passLast" ng-messages="settings.passFirst != settings.passLast">
                                            <div>Пароли не совпадают</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer text-right" >
                            <button type="submit"  class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>


    </section>


@endsection
