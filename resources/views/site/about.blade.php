@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('og:image', asset('site/img/about.jpg'))

@section('controller', 'IndexCtrl')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="home">
                    <h1>Мгновенный поиск сервисных центров по <br> ремонту смартфонов в Днепре</h1>
                    <h2>Наш сервис помогает владельцам смартфонов, сэкономить <br> время и деньги на качественный ремонт устройства, тем, что
                        <br> позволяет найти ближайший сертифицированный сервис-центр <br> за 3 минуты</h2>
                    {{--<a href="{{ route('catalog') }}" class="btn btn-yellow">Найти ближайший сервис-центр</a>--}}

                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <!--======================================= INCLUDE SEARCH SC =======================================-->
                            @include('site.includes.search')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--<div class="container">--}}
    {{--<div class="search-home">--}}

    {{--</div>--}}
    {{--</div>--}}
    <div class="container">
        <div class="advantages">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <img src="{{ asset('site/img/pig-money-safe.png') }}" alt="Экономия денег на ремонте">
                    <h3>Экономия денег на ремонте</h3>
                    <p>Благодаря удобным фильтрам и сортировки, выберите сервис-центр с подходящей ценой</p>
                </div>
                <div class="col-sm-4 col-sm-offset-2">
                    <img src="{{ asset('site/img/quality.png') }}" alt="Сертифицированные компании">
                    <h3>Сертифицированные компании</h3>
                    <p>В нашем каталоге только проверенные сервис-центры, с гарантией качества услуг и реальными отзывами клиентов</p>
                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <img src="{{ asset('site/img/map-location.png') }}" alt="Быстрый поиск ближайшего сервис-центра">
                    <h3>Быстрый поиск ближайшего сервис-центра</h3>
                    <p>Мы покажем Вам ближайшие сервис-центры для ремонта Вашего телефона</p>
                </div>
                <div class="col-sm-4 col-sm-offset-2">
                    {{--<span class="glyphicon glyphicon-map-marker"></span>--}}
                    <img src="{{ asset('site/img/support.png') }}" alt="Определите поломку прямо на сайте">
                    <h3>Определите поломку прямо на сайте</h3>
                    <p>Вместо того чтобы ехать в сервис центр для диагностики, определите причину поломку онлайн, и выберите сервис-центр по оптимальной цене и с удобным расположением</p>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="how-work">
            <div class="row ">
                <div class="col-xs-12 text-center">
                    <h3>Как это работает?</h3>
                </div>
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <span class="glyphicon glyphicon-phone icon"></span>
                            <h4>Выберите Ваше местоположение <br> и марку телефона</h4>
                        </div>
                        <div class="col-sm-4 text-center">
                            <span class="glyphicon glyphicon-search icon"></span>
                            <h4>Сравните предложения <br> сервисных-центров и выберите подходящий</h4>
                        </div>
                        <div class="col-sm-4 text-center">
                            <span class="glyphicon glyphicon-thumbs-up icon"></span>
                            <h4>Сделайте заявку онлайн <br> и отремонтируйте устройство в кратчайшие сроки</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="diagnostics-home">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3>Определите поломку Вашего устройства, <br> сориентируйтесь по цене, <br> и выберите ближайший сервис-центр</h3>
                    <a href="/diagnostics" class="btn btn-yellow out-diagnostics">Провести диагностику устройства</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="help-home">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h3>Нужна помощь <br> в подборе сервис-центра?</h3>
                    <p>Оставьте свой телефон, мы перезвоним в течение 3 минут и <br> бесплатно подберем вам идеальный сервис-центр</p>
                    <button class="btn btn-yellow help-pick-up" data-toggle="modal" data-target="#help_modal">Подобрать</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="advantages-more">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1 text-center">
                    <span class="glyphicon glyphicon-headphones icon"></span>
                    <h3>Онлайн-консультация и помощь в подборе</h3>
                </div>
                <div class="col-sm-2 col-sm-offset-2 text-center">
                    <span class="glyphicon glyphicon-picture icon"></span>
                    <h3>Детальная информация о компаниях: фото, сертификаты, рейтинг</h3>
                </div>
                <div class="col-sm-2 col-sm-offset-2 text-center">
                    <span class="glyphicon glyphicon-bell icon"></span>
                    <h3>Более 50 сервис-центров с подтвержденными данными</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1 text-center">
                    <span class="glyphicon glyphicon-comment icon"></span>
                    <h3>Только проверенные отзывы клиентов</h3>
                </div>
                <div class="col-sm-2 col-sm-offset-2 text-center">
                    <span class="glyphicon glyphicon-alert icon"></span>
                    <h3>Срочный ремонт с возможностью выезда мастера на дом</h3>
                </div>
                <div class="col-sm-2 col-sm-offset-2 text-center">
                    <span class="glyphicon glyphicon-transfer icon"></span>
                    <h3>Эквивалентная замена устройства на время ремонта</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="textt">О проекте</h1>
                <p><b>Boot.com.ua</b> - портал о сервисе и услугах. Это инновационный ресурс всеукраинского масштаба, который сегодня охватывает г. Днепр, а в ближайшей перспективе – всю Украину.</p>
                <p> Это интернет-платформа, на которой собрана вся актуальная информация о сервисных центрах по обслуживанию <b><u>мобильных телефонов</u></b> для быстрого поиска ближайшего СЦ по адресу, видам услуг и другим параметрам.</p>
                <p>Это не просто поисковик, а возможность практически мгновенно определить поломку в Вашем устройстве, провести базовую онлайн-диагностику, подобрать ближайший сервисный центр по подходящим Вам параметрам и получить гарантированно качественный сервис.</p>
                <p>На нашем портале вся информация проверяется менеджерами, постоянно актуализируется и дополняется. Все Исполнители получают «Честный рейтинг» и стремятся быть лучшими.</p>
                <p>Именно поэтому, обратившись в сервисный центр посредством нашего ресурса, Вы получите именно тот сервис, который ожидаете. Ведь это – наша основная задача.</p>
                <p>Введите в поиске Ваш вопрос и получите всё, что Вам нужно!</p>
                <p>А мы позаботимся об остальном!</p>
                <p>Мы находимся на стартовом этапе проекта, и будем безумно рады увидеть Ваши комментарии и пожелания, как сделать ресурс лучше на e-mail:
                    <a href="mailTo: info@boot.com.ua">info@boot.com.ua</a></p>
                <p> Касательно регистрации, обновления информации и других вопросов для Сервисных Центров – партнеров - e-mail:
                    <a href="mailTo:partners@boot.com.ua">partners@boot.com.ua</a></p>
                <p>Мы всегда рады видеть Вас на нашем портале!</p>
                <br>
                <iframe src='https://onedrive.live.com/embed?cid=FF61CA473D9952C1&resid=FF61CA473D9952C1%2194642&authkey=AJCPPZ0Maxv1q6c&em=2&wdAr=1.7777777777777777&wdEaa=1' width='100%' height='691px' frameborder='0'>Это внедренный файл <a target='_blank' href='https://office.com'>Microsoft Office</a> на платформе <a target='_blank' href='https://office.com/webapps'>Office Online</a>.</iframe>
                <br>
                <br>

            </div>
        </div>
    </div>

@endsection