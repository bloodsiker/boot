@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'IndexCtrl')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="textt">Служба поддержки</h1>
            </div>
            <div class="col-xs-12 col-sm-6">

                <h2>Электронная почта</h2>
                <p>Если вам нужна помощь или консультация по работе сервиса, напишите нам письмо на <a href="maito:info@boot.com.ua"></a>info@boot.com.ua</p>
                <p>Служба поддержки партнеров (Сервисные центры и др.):</p>
                <a href="maito:partners@boot.com.ua">partners@boot.com.ua</a>
                <h2>Онлайн чат</h2>
                <p>Для живого общения со службой поддержки вы можете воспользоваться онлайн чатом, кнопка которого находится в правом нижнем углу вашего экрана.</p>
                <h2>Звонок оператора</h2>
                <p>У вас возникли проблемы с заданием или оплатой? Заполните форму обратной связи, и наш оператор перезвонит Вам в любую точку мира (Пн — Пт: c 9:00 до 18:00).</p>


            </div>
            <div class="col-xs-12 col-sm-6">
                <form name="help_form">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text"
                               class="form-control"
                               required
                               placeholder="Введите имя"
                               name="client_name"
                               ng-model="client_name">
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text"
                               class="form-control phone-input"
                               required
                               placeholder="+38 (123) 456-78-90"
                               name="client_phone"
                               ng-model="client_phone">
                    </div>
                    <div class="form-group">
                        <label for="client_comment">Комментарий</label>
                        <textarea name="client_comment"
                                  id="client_comment"
                                  ng-model="client_comment"
                                  class="form-control"
                                  cols="30"
                                  rows="5"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-yellow" ng-click="supportCall(help_form.$valid, client_name, client_phone, client_comment)">
                            Отправить
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection
