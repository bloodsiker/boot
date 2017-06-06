@extends('service_center_cabinet.layouts.master')

@section('content')
    <div flex layout="column">
        <form name="settingForm" action="{{ route('cabinet.settings') }}" method="post" ng-click="addSettingsSc($event, settingForm.$valid, settings)" flex layout="row" novalidate>
            <div flex="50" layout="column" layout-padding>
                {{ csrf_field() }}
                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 success">
                            {{ Session::get('message') }}
                        </div>
                    </div>
                @endif
                <div layout="row" >
                    @if(Auth::user()->change_email == 0)
                        <div>Email можно изменить только один раз!</div>
                    @else
                        <div>Вы уже изменяли email, повторное изменение не доступно!</div>
                    @endif
                </div>
                <div layout="row" >
                    <md-input-container flex>
                        <label>Email</label>
                        <input type="email" ng-disabled="{{ Auth::user()->change_email }}" name="email" ng-init="settings.email='{{ Auth::user()->email}}'" ng-model="settings.email" required>
                        <div ng-messages="settingForm.email.$error">
                            <div ng-message="required">Это поле обязательное для ввода.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row" >
                    <md-input-container flex>
                        <label>Имя</label>
                        <input type="text"  name="name" ng-init="settings.name='{{ Auth::user()->name}}'" ng-model="settings.name" required>
                        <div ng-messages="settingForm.name.$error">
                            <div ng-message="required">Это поле обязательное для ввода.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container flex>
                        <label>Пароль</label>
                        <input type="password" name="passFirst" ng-model="settings.passFirst" required>
                        <div ng-messages="settingForm.passFirst.$error">
                            <div ng-message="required">Это поле обязательное для ввода.</div>
                        </div>
                    </md-input-container>
                    <md-input-container flex>
                        <label>Подтвердите пароль</label>
                        <input type="password" name="passLast" ng-model="settings.passLast" required>
                        <div ng-messages="settingForm.passLast.$error">
                            <div ng-message="required">Это поле обязательное для ввода.</div>
                        </div>
                        <div ng-if="settings.passFirst != settings.passLast" ng-messages="settings.passFirst != settings.passLast">
                            <div>Пароли не совпадают</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex></div>
                <div layout="row">
                    <span flex></span>
                    <md-button type="submit"  class="md-primary md-raised md-fab-bottom-right">Сохранить</md-button>
                </div>
            </div>
        </form>
    </div>



@endsection
