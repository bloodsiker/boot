@extends('service_center_cabinet.layouts.master')

@section('content')
    <div flex layout="column">
        <form name="settingForm" action="#" method="post" ng-click="addSettingsSc($event, settingForm.$valid, settings)" flex layout="row" novalidate>
            <div flex="50" layout="column" layout-padding>
                <div layout="row">
                    <md-input-container flex>
                        <label>Email</label>
                        <input type="email" name="login" ng-model="settings.login" required>
                        <div ng-messages="settingForm.login.$error">
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
                            <div>Подтвердите пароль.</div>
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
