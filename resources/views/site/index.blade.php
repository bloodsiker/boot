@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'IndexCtrl')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="home">
                    <h1>Мгновенный поиск сервисных центров по <br> ремонту смартфонов в Днепре</h1>
                    <h2>Наш сервис помогает владельцам смартфонов, сэкономить <br> время и деньги на качественный ремонт устройства, тем, что
                        <br> позволяет найти ближайший сертифицированный сервис-центр <br> за 3 минуты</h2>
                    <a href="{{ route('catalog') }}" class="btn btn-warning">Найти ближайший сервис-центр</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row advantages">
            <div class="col-md-4 col-md-offset-1">
                <img src="{{ asset('site/img/pig-money-safe.png') }}" alt="Экономия денег на ремонте">
                <h3>Экономия денег на ремонте</h3>
                <p>Благодаря удобным фильтрам и сортировки, выберите сервис-центр с подходящей ценой</p>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <img src="{{ asset('site/img/quality.png') }}" alt="Сертифицированные компании">
                <h3>Сертифицированные компании</h3>
                <p>В нашем каталоге только проверенные сервис-центры, с гарантией качества услуг и реальными отзывами клиентов</p>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <img src="{{ asset('site/img/map-location.png') }}" alt="Быстрый поиск ближайшего сервис-центра">
                <h3>Быстрый поиск ближайшего сервис-центра</h3>
                <p>Мы покажем Вам ближайшие сервис-центры для ремонта Вашего телефона</p>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <img src="{{ asset('site/img/support.png') }}" alt="Определите поломку прямо на сайте">
                <h3>Определите поломку прямо на сайте</h3>
                <p>Вместо того чтобы ехать в сервис центр для диагностики, определите причину поломку онлайн, и выберите сервис-центр по оптимальной цене и с удобным расположением</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row how-work">
            <div class="col-xs-12 text-center">
                <h3>Как это работает?</h3>
            </div>
            <div class="col-md-2 col-md-offset-1 text-center">
                <span class="glyphicon glyphicon-phone"></span>
                <h4>Выберите Ваше местоположение и марку телефона</h4>
            </div>
            <div class="col-md-2 col-md-offset-2 text-center">
                <span class="glyphicon glyphicon-search"></span>
                <h4>Сравните предложения сервисных-центров и выберите подходящий</h4>
            </div>
            <div class="col-md-2 col-md-offset-2 text-center">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                <h4>Сделайте заявку онлайн и отремонтируйте устройство в кратчайшие сроки</h4>
            </div>
        </div>
    </div>
    <div class="diagnostics-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Определите поломку Вашего устройства, <br> сориентируйтесь по цене, <br> и выберите ближайший сервис-центр</h3>
                    <a href="/diagnostics" class="btn btn-warning">Провести диагностику устройства</a>
                </div>
            </div>
        </div>
    </div>
    <div class="help-home">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h3>Нужна помощь <br> в подборе сервис-центра?</h3>
                    <p>Оставьте свой телефон, мы перезвоним в течение 3 минут и <br> бесплатно подберем вам идеальный сервис-центр</p>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#help_modal">Подобрать</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container advantages-more">
        <div class="row">
            <div class="col-md-2 col-md-offset-1 text-center">
                <span class="glyphicon glyphicon-headphones"></span>
                <h3>Онлайн-консультация и помощь в подборе</h3>
            </div>
            <div class="col-md-2 col-md-offset-2 text-center">
                <span class="glyphicon glyphicon-picture"></span>
                <h3>Детальная информация о компаниях: фото, сертификаты, рейтинг</h3>
            </div>
            <div class="col-md-2 col-md-offset-2 text-center">
                <span class="glyphicon glyphicon-bell"></span>
                <h3>Более 50 сервис-центров работающих в режиме 24/7</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1 text-center">
                <span class="glyphicon glyphicon-comment"></span>
                <h3>Только проверенные отзывы клиентов</h3>
            </div>
            <div class="col-md-2 col-md-offset-2 text-center">
                <span class="glyphicon glyphicon-alert"></span>
                <h3>Срочный ремонт с возможностью выезда мастера на дом</h3>
            </div>
            <div class="col-md-2 col-md-offset-2 text-center">
                <span class="glyphicon glyphicon-transfer"></span>
                <h3>Эквивалентная замена устройства на время ремонта</h3>
            </div>
        </div>
    </div>


    <div class="search-home">
        <div class="container">
            <!--======================================= INCLUDE SEARCH SC =======================================-->
            @include('site.includes.search')
        </div>
    </div>

@endsection
