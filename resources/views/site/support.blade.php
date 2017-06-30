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
                <h2>Электронная почта</h2>
                <p>Если вам нужна помощь или консультация по работе сервиса, напишите нам письмо на <a href="maito:info@boot.com.ua"></a>info@boot.com.ua</p>
                <p>Служба поддержки партнеров (Сервисные центры и др.):</p>
                <a href="maito:partners@boot.com.ua">partners@boot.com.ua</a>
                <h2>Онлайн чат</h2>
                <p>Для живого общения со службой поддержки вы можете воспользоваться онлайн чатом, кнопка которого находится в правом нижнем углу вашего экрана.</p>
                <h2>Звонок оператора</h2>
                <p>У вас возникли проблемы с заданием или оплатой? Заполните форму обратной связи, и наш оператор перезвонит Вам в любую точку мира (Пн — Пт: c 9:00 до 18:00).</p>

            </div>
        </div>
    </div>


@endsection