<!--============== FOOTER =========================-->


<div class="container" style="margin-top: -108px;">
    <hr>
    <div class="footer">
        <div class="row">
            <div class="col-sm-2">
                <div class="logo-footer">
                    <img src="{{ asset('site/img/logo.png') }}" alt="boot">
                </div>
            </div>
            <div class="col-sm-3">
                <ul>
                    <li><a href="{{ route('about') }} " class="{{ active('about') }}">О проекте</a></li>
                    <li><a data-toggle="modal" data-target="#terms_modal">Пользовательское соглашение</a></li>
                    <li><a href="{{ route('catalog') }}" class="{{ active('catalog') }}">Каталог сервис-центров</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul>
                    <li><a href="{{ route('diagnostics') }} " class="{{ active('diagnostics') }}">Диагностика</a></li>
                    <li><a data-toggle="modal" data-target="#help_modal">Помощь в подборе</a></li>
                    <li><a href="{{ route('service.registration') }}">Регистрация сервис-центров</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <ul>
                    {{--<li><a href="tel:0 800 256-357" class="phone"><i class="glyphicon glyphicon-phone"></i> 0 800--}}
                            {{--256-357</a> <span>Звонки по Украине бесплатны</span></li>--}}
                    <li><a href="mailTo:Support@fix.com" class="mail"><i class="glyphicon glyphicon-send"></i>
                            info@boot.com.ua</a></li>
                    <li><span class="time"><i class="glyphicon glyphicon-time"></i> Пн — Пт: c 9:00 до 18:00</span></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <span>© 2017 Boot.com.ua. Все права защищены.</span>
            </div>
        </div>
    </div>
</div>


<!--==============MODAL PHOTO=========================-->

<div class="modal lg fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="show photo">
    <div class="modal-dialog" role="document">
        <div class="modal-content photo-show text-center">
            <img ng-src="@{{photoUrl}}">
        </div>
    </div>
</div>


<!--==============MODAL ADD COMMENT=========================-->

<div class="modal fade" id="add_comment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Добавить комментарий</h4>
            </div>
            <form novalidate name="add_comment_form">
                <div class="modal-body">
                    <div class="row comment-item">
                        <div class="col-sm-4">
                            @if(Auth::check() && Auth::user()->roleUser())
                                <img class="avatar" src="{{ asset(Auth::user()->avatar) }}" alt="client-user">
                            @else
                                <img class="avatar" src="{{ asset('site/img/logo_user_default.png') }}" alt="client-user">
                            @endif
                            <h4 class="name">
                                <input type="text"
                                       ng-minlength="2"
                                       required
                                       ng-class="{'input-error': add_comment.user_name.length == 0 && add_comment_valid}"
                                       ng-model="add_comment.user_name" placeholder="Иванов Иван Иванович"
                                       value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->name : '' }}"
                                       class="input "/>
                            </h4>
                            <div class="device-name">Устройство
                                <input type="text"
                                       required
                                       ng-minlength="2"
                                       ng-class="{'input-error': add_comment.device_name.length == 0 && add_comment_valid}"
                                       ng-model="add_comment.device_name" placeholder="Motorola Moto G"
                                       class="input "/>
                            </div>
                            <div class="service-name">Услуга
                                <input type="text"
                                       required
                                       ng-minlength="2"
                                       ng-class="{'input-error': add_comment.service_name.length == 0 && add_comment_valid}"
                                       ng-model="add_comment.service_name" placeholder="Замена экрана"
                                       class="input "/>
                            </div>
                            <div class="service-name">Номер услуги
                                <input type="text"
                                       required
                                       ng-minlength="10"
                                       ng-maxlength="10"
                                       ng-class="{'input-error': add_comment.service_number.length == 0 && add_comment_valid}"
                                       ng-model="add_comment.service_number" placeholder="H3b23b4n21"
                                       class="input "/>
                            </div>
                            <hr>
                            <div class="rating-details">
                                <div><span>Качество работ</span>
                                    <rating value="add_comment.rating.quality_of_work" interactive="true"
                                            max="5"></rating>
                                </div>
                                <div><span>Соблюдение сроков</span>
                                    <rating value="add_comment.rating.deadlines" interactive="true"
                                            max="5"></rating>
                                </div>
                                <div><span>Соблюдение стоимости</span>
                                    <rating value="add_comment.rating.compliance_cost" interactive="true"
                                            max="5"></rating>
                                </div>
                                <div><span>Цена/качество</span>
                                    <rating value="add_comment.rating.price_quality" interactive="true"
                                            max="5"></rating>
                                </div>
                                <div><span>Обслуживание</span>
                                    <rating value="add_comment.rating.service" interactive="true" max="5"></rating>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <textarea autofocus
                                      required
                                      ng-class="{'input-error': add_comment.text.length == 0 && add_comment_valid}"
                                      class="add-comment-text " ng-model="add_comment.text"
                                      name="add_comment_text"
                                      placeholder="Оставьте здесь свой комментарий..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-black" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-yellow" ng-click="add_comment_btn(add_comment_form.$valid, add_comment)">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--==============MODAL SUCCESS COMMENTS=========================-->

<div class="modal fade" id="success_comment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h4>Комментарий отправлен на модерацию, в скором времени он появиться на сайте</h4>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 100%;" class="btn btn-black" data-dismiss="modal">Понятно!</button>
            </div>
        </div>
    </div>
</div>



<!--==============MODAL SUCCESS COMMENTS=========================-->

<div class="modal fade" id="success_call_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h4>С вами свяжутся в ближайшее время</h4>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 100%;" class="btn btn-black" data-dismiss="modal">Понятно!</button>
            </div>
        </div>
    </div>
</div>



<!--==============MODAL REGISTER REDIRECT=========================-->

<div class="modal fade" id="auth_error" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" style="position: absolute;right: 10px;z-index: 23;opacity: 1;top: 10px;" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <div class="boot-registration__columns form-sign-in" style="margin: 0;">
                <div class="row">

                    <div class="col-md-6 col-xs-12 no-padding boot-registration__column">
                        <div class="login-box-sc">
                            <div style="text-align: center">
                                <h3>Войти</h3>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <a href="https://www.boot.com.ua/auth/facebook" class="btn btn-primary">facebook</a>
                                    <a href="https://www.boot.com.ua/auth/google" class="btn btn-danger">google+</a>
                                    <a href="https://www.boot.com.ua/auth/linkedin" class="btn btn-primary">linkedin</a>
                                </div>

                                <div class="form-separator">
                                    <span class="form-separator-text">или заполните форму</span>
                                </div>
                            </div>

                            <form action="https://www.boot.com.ua/user/login" method="post" class="ng-pristine ng-valid">
                                <input type="hidden" name="_token" value="W40wq3mc7HcMxjFXmGnzsEw7R1KXMugv7CYKtAGl" autocomplete="off">
                                <label>
                                    Email:
                                    <input type="text" name="email" class="form-control" required="">
                                </label>
                                <label>
                                    Пароль:
                                    <input type="password" name="password" class="form-control" required="">
                                </label>
                                <button class="btn btn-warning pull-right">Вход</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-12 no-padding boot-registration__column">
                        <div class="login-box-sc login-form-sc" style="min-height: 413px; padding-top: 50px">
                            <h2>Нет аккаунта?</h2>
                            <p>Присоединяйтесь к нам!</p>
                            <p>После регистрации у вас будет возможность отслеживать статусы выполнения выших заказов.</p>
                            <p>Вести диалог с сервисным центром по конкретном заказе</p>
                            <p>Добавлять понравившиеся сервисные центры в избранные</p>
                            <br>
                            <a href="https://www.boot.com.ua/user/registration" class="btn btn-warning pull-right">Зарегистрировать</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!--==============MODAL HELP CALL SC=========================-->

<div class="modal fade" id="help_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form name="help_form">
                <div class="modal-header">
                    <button type="button" class="close"  style="font-size: 48px;" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Помощь в подборе</h4>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text"
                                   class="form-control"
                                   required
                                   placeholder="Введите имя"
                                   name="client_name"
                                   value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->name : '' }}"
                                   ng-model="client_name">
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="text"
                                   class="form-control phone-input"
                                   required
                                   placeholder="+38 (123) 456-78-90"
                                   name="client_phone"
                                   value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->phone : '' }}"
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-black" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-yellow" ng-click="helpCall(help_form.$valid, client_name, client_phone, client_comment)">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--==============MODAL CALL US=========================-->


<div class="modal fade" id="call_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="call_form">
                <div class="modal-header">
                    <button type="button" class="close"  style="font-size: 48px;" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Связаться</h2>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="client_name">Имя</label>
                                <input type="text" id="client_name" class="form-control"
                                       placeholder="Имя"
                                       name="client_name"
                                       value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->name : '' }}"
                                       required
                                       ng-model="data.client_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="client_phone">Телефон</label>
                                <input type="text" id="client_phone" class="form-control phone-input"
                                       placeholder="+38 (123) 456-78-90"
                                       name="client_phone"
                                       value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->phone : '' }}"
                                       required
                                       ng-model="data.client_phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="client_email">Email</label>
                                <input type="email" id="client_email" class="form-control"
                                       placeholder="Email"
                                       name="client_email"
                                       value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->email : '' }}"
                                       required
                                       ng-model="data.client_email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" ng-if="sc.manufacturers.length > 0">
                                <label for="client_manufacturer">Производитель телефона</label>
                                <select name="client_manufacturer"
                                        id="client_manufacturer"
                                        class="form-control"
                                        ng-model="data.client_manufacturer">
                                    <option ng-repeat="manufacturer in sc.manufacturers | orderBy: 'manufacturer' track by $index" value="@{{ manufacturer.manufacturer }}">@{{ manufacturer.manufacturer }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group" ng-if="sc.price.length > 0">
                                <label for="client_service">Услуга</label>
                                <select name="client_service"
                                        id="client_service"
                                        ng-change="serviceSelected(data.client_service)"
                                        class="form-control"
                                        ng-model="data.client_service">
                                    <option ng-repeat="price in sc.price track by $index"value="@{{ price.title }}">@{{ price.title }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="client_payment_type">Способ оплаты</label>
                                <select name="client_payment_type"
                                        class="form-control"
                                        id="client_payment_type"
                                        ng-model="data.client_payment_type">
                                    <option value="@{{ payment_type }}" ng-repeat="payment_type in payment_types track by $index">@{{ payment_type }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" ng-if="sc.exit_master === '1'">
                                <input type="checkbox" id="client_exit_master" ng-model="data.client_exit_master">
                                <label for="client_exit_master">Выезд мастера (+50 грн)</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" ng-if="data.client_exit_master">
                                <label for="client_address">Адрес</label>
                                <input type="text" class="form-control" id="client_address"
                                       value="{{ (Auth::check() && Auth::user()->roleUser()) ? Auth::user()->address : '' }}"
                                       ng-model="data.client_address">
                            </div>
                        </div>

                        <div class="col-sm-12" ng-if="sc.price.length > 0">
                            <h3>Примерная стоимость <small>от</small><b><u> @{{ sc.price[serviceIndex].price_min }}</u></b> <small>до</small>
                                <b><u>@{{ sc.price[serviceIndex].price_max }}грн</u></b> <small uib-tooltip="Выезд мастера" ng-if="data.client_exit_master"><i>+ 50грн</i></small></h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="client_task_description">Описание проблемы</label>
                                <textarea name="client_task_description"
                                          id="client_task_description"
                                          ng-model="data.client_task_description"
                                          class="form-control"
                                          cols="30"
                                          rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-black" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-yellow" ng-click="scCall(call_form.$valid, data)">
                        Связаться
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--==============MODAL TERMS=========================-->

<div class="modal fade" id="terms_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" style="font-size: 48px;" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Пользовательское соглашение</h4>
            </div>
            <div class="modal-body" style="padding: 40px;">
                        <h1>Правила конфиденциальности</h1>
                        <p>
                            Настоящие Правила конфиденциальности (далее - “Правила”) являются неотъемлемой частью Публичной Оферты на оказание услуг (далее - “Публичная Оферта”). Термины и понятия, используемые в настоящих Правилах аналогичны терминам и понятиям, используемым в основном тексте Публичной Оферты. Используя ресурс, а также Сервисы и Услуги, предоставляемые Компанией, Посетитель и/или Пользователь выражает свое согласие с данными Правилами. В случае отказа Посетителя и/или Пользователя от соблюдения данных Правил, он обязан прекратить использование Ресурса.
                        </p>
                        <p>
                            Правила распространяются на любые Услуги и Сервисы, предлагаемые Компанией через домен boot.com.ua.
                        </p>
                        <h2>Понятие конфиденциальной информации</h2>
                        <p>
                            Под конфиденциальной понимается вся идентифицирующая информация, полученная Компанией от Посетителя и/или Пользователя во время его пребывания на сайтах Компании и/или при использовании Сервисов, предоставляемых Компанией. Эта информация, в случае необходимости, может быть использована для контактов с Пользователем и/или Посетителем, как в онлайн режиме, так и другими способами. Персональные данные являются составляющей частью конфиденциальной информации, предоставляемой Пользователем и/или Посетителем исключительно на добровольной основе и с его согласия. Для доступа к ресурсу Компании предоставление конфиденциальной информации необязательно, но в этом случае некоторые разделы Сервисы и Услуги могут оказаться недоступными.
                        </p>

                        <h3>Состав конфиденциальной информации:</h3>
                        <ol>
                            <li>Персональные данные</li>
                            <li>Файлы cookie</li>
                            <li>Журналы серверов</li>
                        </ol>

                        <h3>Состав персональных данных:</h3>
                        <ol>
                            <li>Фамилия, имя, отчество</li>
                            <li>Дата рождения, пол, место жительства</li>
                            <li>Адрес электронной почты</li>
                            <li>Серия и номер паспорта</li>
                            <li>Координаты, определяющие местонахождение мобильного устройства, на котором установлено приложение для доступа к Сервису</li>
                            <li>Номер мобильного телефона</li>
                            <li>Фотография пользователя</li>
                        </ol>

                        <h3>Цели сбора конфиденциальной информации:</h3>
                        <ol>
                            <li>Регистрация Пользователей</li>
                            <li>Обеспечение функционирования Сервисов, Ресурса и оказание Услуг Компанией</li>
                            <li>Проведение маркетинговых исследований и сбор статистики</li>
                            <li>Улучшение Сервисов и Услуг Компании</li>
                            <li>Координаты, определяющие местонахождение мобильного устройства, на котором установлено приложение для доступа к Сервису</li>
                            <li>Номер мобильного телефона</li>
                            <li>Возможность внесения изменений в учетную запись Пользователя в случае возникновения непредвиденных ситуаций (например, восстановление пароля в случае его кражи).</li>
                        </ol>

                        <h3>Использование личной информации:</h3>
                        <p>Компания обязуется не способствовать распространению персональных данных Пользователей и не передавать данную информацию третьим лицам, за исключением следующих случаев:</p>
                        <ol>
                            <li>Пользователь добровольно и явным образом пожелал раскрыть эту информацию</li>
                            <li>Персональные данные подлежат распространению в соответствии с действующим законодательством Украины</li>
                            <li>Пользователь допустил нарушение Публичной Оферты</li>
                            <li>Серия и номер паспорта</li>
                            <li>Координаты, определяющие местонахождение мобильного устройства, на котором установлено приложение для доступа к Сервису</li>
                            <li>С предварительного согласия Пользователя, явно выраженного посредством Сервисов ресурса</li>
                        </ol>

                        <p>
                            Компания может проводить статистические, демографические и маркетинговые исследования, используя конфиденциальную информацию. Результаты данных исследований не являются конфиденциальной информацией. В любом случае Компания гарантирует, что результаты исследований будут использоваться без какой-либо связи с личной информацией, представленной Пользователем и не позволят идентифицировать конкретного Пользователя. Пользователь выражает свое согласие на получение личных сообщений от Администрации на адрес электронной почты в любое время и любого характера, в том числе и рекламного.
                        </p>
                        <h3>Размещение Пользователем информации о себе при использовании ресурса</h3>
                        <p>
                            Пользователь может по своему желанию предоставлять третьим лицам любую информацию о себе в ходе пользования Ресурсом. Данная информация расценивается как общедоступная, и, следовательно, Компания не несет никакой ответственности за последствия таких действий Пользователя. Пользователь гарантирует, что информация, предоставляемая третьим лицам и Компании не может:
                        </p>

                        <ol>
                            <li>быть ложной, неточной или вводящей в заблуждение</li>
                            <li>способствовать мошенничеству, обману или злоупотреблению доверием</li>
                            <li>нарушать или посягать на собственность третьего лица, его коммерческую тайну либо его право на неприкосновенность частной жизни</li>
                            <li>призывать к совершению преступления, а также разжигать межнациональную рознь</li>
                            <li>содержать сведений, оскорбляющих чью-либо честь, достоинство или деловую репутацию, клевету или угроз кому бы то ни было</li>
                            <li>быть непристойными, либо носить характер порнографии или эротики</li>
                            <li>фотографией профиля может служить только реальная фотография пользователя. Запрещено использовать картинки и фотографии других людей в качестве фотографии профиля. Лицо на фотографии профиля должно быть отчетливо видно и занимать не менее 50%% фотографии</li>
                            <li>содержать компьютерные вирусы, а также иные компьютерные программы, направленные, в частности, на нанесение вреда, неуполномоченное вторжение, тайный перехват либо присвоение данных</li>
                            <li>содержать материалы рекламного характера</li>
                            <li>иным образом нарушать действующее законодательство Украины</li>
                        </ol>

                        <h3>Сбор и хранение конфиденциальной информации</h3>
                        <p>
                            Компания осуществляет сбор, хранение и использование конфиденциальной информации в строгом соответствии с настоящими Правилами. Компания принимает все необходимые меры для того, чтобы надлежащим образом обеспечить хранение и использование полученной информации. Сбор конфиденциальной информации происходит автоматически при посещении ресурса и использовании Сервисов и Услуг Компании, а также при заполнении Пользователем и/или Посетителем предлагаемых форм.
                        </p>
                        <p>
                            Компания делает все возможное, чтобы свести к минимуму риск несанкционированного доступа к конфиденциальной информации, а также риск ее ненадлежащего использования, однако не несет никакой ответственности в случае получения доступа к конфиденциальной информации третьими лицами. В случае возникновения спорных ситуаций при использовании ресурса, Услуг и Сервисов Компании, а также в иных случаях, предусмотренных Публичной Офертой об использовании ресурса “Boot.com.ua” или действующим законодательством Украины, Пользователь и/или Посетитель обязуется предоставить Компании персональные данные по ее запросу, в том числе и в письменном виде. Компания оставляет за собой право хранить всю конфиденциальную информацию, касающуюся Пользователя в течение 5 лет после отказа Пользователя от использования ресурса “Boot.com.ua”, в том числе изменяемые и измененные персональные данные.
                        </p>


                        <h1>Публичная Оферта (Договор) на оказание услуг</h1>
                        <h2>1. Термины, используемые в Публичной Оферте</h2>
                        <p>
                            Сайт, Ресурс, Сервис
                            интернет-ресурс boot.com.ua. Общество с ограниченной ответственностью “__________” (ЕГРПОУ __________).
                            Администрация
                            сотрудники Ресурса, а также лица, уполномоченные надлежащим образом Ресурсом на управление Сайтом и предоставление Услуг Посетителям, в рамках использования Сайта последними.
                            Сервисы
                            совокупность программ для ЭВМ, баз данных, обеспечивающих функционирование Сайта, а также совокупность Услуг, предоставляемых Пользователям при использовании Сайта.
                            Посетитель
                            любое физическое лицо, старше 16 лет, использующее Ресурс.
                            Пользователь (Заказчик или Исполнитель)
                            Посетитель, прошедший процедуру регистрации. Термином Заказчик/Исполнитель в настоящей Публичной Оферте обозначаются как Проверенные исполнители, так и Непроверенные исполнители.
                            Логин
                            идентификатор Пользователя при авторизации на Сайте. В качестве Логина используется номер мобильного телефона или адрес электронной почты.
                            Пароль
                            символьная комбинация, выбираемая Пользователем самостоятельно или назначенная Сайтом автоматически (в момент регистрации) и обеспечивающая в совокупности с Логином его идентификацию при использовании Ресурса.
                            Непроверенный исполнитель
                            Пользователь, который не прошел процедуру проверки, в соответствии с Разделом 4 Публичной Оферты.
                            Проверенный исполнитель
                            Пользователь, прошедший процедуру проверки, в соответствии с Разделом 4 Публичной Оферты.
                            Компания (сервис-центр)
                            Посетитель, прошедший процедуру регистрации, в режиме "Компания" (сервис-центр).
                            Заказчик
                            Пользователь, прошедший процедуру регистрации. Пользователь, либо Компания разместившие Задание на Сайте, в соответствии с Правилами размещения и выполнения заданий.
                            Задание
                            объявление, размещенное на Сайте Заказчиком и адресованное заинтересованным исполнителям и содержит условия оферты (предложения Заказчика о заключении договора на оказание услуг/выполнение работ).
                            Объявление
                            текст и графические изображения, описывающие опыт работы и компетентность исполнителя в конкретной категории услуг, адресованное заказчикам с целью персональной рекламы для получения задания.
                            Приватная информация
                            Сервис позволяющий Заказчику разместить информацию, необходимую для выполнения работ/оказания услуг в соответствии с Заданием, и сделать ее доступной только Исполнителю, который будет выбран. Приватное поле не может содержать информацию, меняющую существенные условия предложения делать оферты.
                            Предложение
                            бесплатная оферта (предложения Исполнителя о заключении договора на оказание услуг/выполнение работ), размещенная Исполнителем и адресованная Заказчику Задания.
                            Выбор Исполнителя
                            акцепт Предложения Заказчиком задания или выбор Исполнителя Сервисом автоматически (при указании соответствующего типа выбора Исполнителя при создании Задания).
                            Баланс
                            виртуальный счет Пользователя на сайте.
                            Кошелек
                            Сервис на Сайте, который дает возможность Пользователям производить операции пополнения, хранения и перечисления электронных денежных средств в рамках своего Баланса.
                            Бонусы
                            виртуальные вознаграждения при пополнении баланса. Могут использоваться только для оплаты услуг сервиса и не могут быть выведены с баланса как реальные деньги.
                            Учетное время
                            киевское время. Все даты, указываемые при использовании Сайта и Сервисов, учитываются по киевскому времени.
                            Сумма Задания
                            стоимость услуг/работ Исполнителя в рамках заключенного Договора на оказание услуг/выполнение работ между Заказчиком и Исполнителем.
                            Правила конфиденциальности
                            условия работы Ресурса (Администрации) с конфиденциальной информацией на Сайте. Действующая версия размещена на Сайте, по адресу: http://www.boot.com.ua/ (футер сайта)
                            Правила начала работы на сайте
                            подробное описание правил работы на сайте, описание и функционала, процедур регистрации и пользователя хранится у Администрации и предоставляется по запросу с возможностью дальнейшей публикации на Сайте.
                        </p>
                        <h2>2. Общие положения</h2>
                        <p>
                            Настоящая Публичная Оферта регулирует порядок оказания услуг Ресурса на Сайте и порядок использования Сайта, а также взаимоотношения, возникающие при использовании Сайта и Сервисов Посетителями. Ресурс не гарантирует доступность Сайта и Сервисов круглосуточно. Ресурс имеет право в любой момент отказать любому Посетителю, в том числе Пользователю, в использовании Сайта и Сервисов при нарушении Публичной Оферты. Ресурс предоставляет Посетителям, Пользователям личное неисключительное и непередаваемое право использовать Сайт и программное обеспечение, представленное на Сайте, в соответствии с настоящей Публичной Офертой, при условии, что ни Посетитель/Пользователь, ни любые иные лица при содействии Посетителя/Пользователя не будут совершать действий:
                        </p>
                        <ul>
                            <li>по копированию или изменению программного обеспечение Сайта, Сервисов</li>
                            <li>по созданию программ, производных от программного обеспечения Сайта и Сервисов</li>
                            <li>по проникновению в программное обеспечение с целью получения кодов программ</li>
                            <li>по осуществлению продажи, уступки, сдачи в аренду, передачи третьим лицам в любой иной форме прав в отношении материала Сайта и программного обеспечения Сайта</li>
                            <li>по модифицированию Сайта, и Сервисов в том числе с целью получения несанкционированного доступа к нему</li>
                            <li>и иных действий, аналогичных перечисленным выше и нарушающих права Ресурса и третьих лиц</li>
                        </ul>
                        <p>
                            Посетитель/Пользователь несет ответственность за соблюдение прав (материальных и нематериальных) третьих лиц на информацию, переданную (предоставленную) Администрации или третьим лицам при использовании Сайта и Сервисов. Пользователи самостоятельно оценивают правомерность использования ими Сайта и Сервисов, в том числе и с точки зрения действующего законодательства Украины.
                        </p>
                        <p>
                            Помимо настоящей Публичной Оферты, порядок оказания услуг на Сайте определяются следующими документами:
                        </p>
                        <ul>
                            <li>Правила конфиденциальности</li>
                            <li>Правила начала работы на сайте</li>
                        </ul>
                        <h3>3. Регистрация Пользователя</h3>
                        <p>
                            Лицо, желающее стать Заказчиком/Исполнителем, обязано пройти процедуру регистрации на соответствующей странице Ресурса. При регистрации Заказчик/Исполнитель указывает имя и фамилию (или название компании), уникальный номер мобильного телефона, уникальный адрес электронной почты, которые используются в дальнейшем Заказчиком/Исполнителем при работе с Сайтом. Не допускается использование Логина:
                        </p>
                        <ol>
                            <li>уже используемого иным Заказчиком/Исполнителем</li>
                            <li>оскорбляющего Посетителей, Ресурс, Администрацию, третьих лиц</li>
                        </ol>
                        <p>
                            Пароль генерируется Администратором и отсылается на указанный e-mail при первичной регистрации Исполнителя, указывается Пользователем при самостоятельной регистрации. После этого Пользователь может самостоятельно изменить Пароль, однако Сайт настоятельно рекомендует использовать пароли, которые состоят из не менее 6 (шести) символов и включающие одновременно строчные и заглавные буквы, а также цифры. Пользователь самостоятельно несет ответственность за сохранность Пароля от третьих лиц. Ресурс не несет ответственности в случае нарушения прав Пользователя третьими лицами, получившими несанкционированный доступ к Логину и Паролю Заказчика/Исполнителя.
                        </p>
                        <h3>1. Проверка исполнителей</h3>
                        <p>
                            Использование некоторых Сервисов и услуг Ресурса возможно только после проверки. Последним этапом регистрации для Исполнителей является подтверждение паспортных данных. Пользователь указывает имя, фамилию, отчество, дату рождения, контактный номер телефона, серию и номер паспорта, фото первой страницы паспорта, держа его в руках рядом с лицом, фото страницы паспорта с текущей пропиской, адрес прописки, адрес проживания и соглашается на использование указанной информации, ее обработку и хранение сервисом Boot.com.ua. В случае проверки Компании, необходимо указать наименование юридического лица или ФИО ЧП, ФИО ответственного лица, код ЕГРПОУ или ИНН ЧП, загрузить копию свидетельства о регистрации, логотип компании (или фото ответственного лица), фактический адрес компании. Со своей стороны, сервис Boot.com.ua гарантирует безопасность персональных данных, которые предоставил пользователь. Фото с документом, загруженные в анкету сверяются отделом верификации с указанными данными в анкете. Данные защищены от доступа неуполномоченных лиц. И права пользователей в сфере защиты прав персональных данных не будут нарушены Сервисом.
                        </p>
                        <p>
                            Регистрация на сайте для жителей временно оккупированной территории Украины (Донецкой, Луганской областей и АР Крым) возможна при условии предъявления справки о взятии на учет внутренне перемещенных лиц. В соответствии с положениями Закона Украины "Об обеспечении прав и свобод внутренне перемещенных лиц", данная справка подтверждает законные основания пребывания внутренне перемещенных лиц на территории Украины.
                        </p>
                        <p>
                            Статус проверенного Пользователя может быть снят с Пользователя в любой момент по усмотрению Администрации. Также Администрация оставляет за собой право отклонить анкету Исполнителя без объяснения причин.
                        </p>
                        <h3>2. Права и обязанности Пользователя и Посетителя</h3>
                        <p>Любой Посетитель Ресурса имеет право использовать следующие Сервисы:</p>
                        <ul>
                            <li>просмотр аудиовизуальных произведений, фотографий, прослушивание фонограмм, размещенных Пользователями, доступных для такого просмотра и прослушивания в соответствии с настоящей Публичной Офертой;</li>
                            <li>иные сервисы, доступ к которым предоставлен ему Ресурсом в лице Администрации.</li>
                        </ul>
                        <p>
                            Пользователь дополнительно имеет право:
                        </p>
                        <ul>
                            <li>создавать Задания и выбирать Исполнителя Задания;</li>
                            <li>направлять жалобы Администрации по фактам нарушения Пользователями Публичной Оферты;</li>
                            <li>использовать иные сервисы, доступ к которым предоставлен ему Ресурсом в лице Администрации.</li>
                        </ul>
                        <p>
                            Исполнитель дополнительно имеет право:
                        </p>
                        <ul>
                            <li>выполнять Задания всех видов;</li>
                            <li>использовать иные сервисы, доступ к которым предоставлен ему Ресурсом в лице Администрации.</li>
                        </ul>
                        <h3>3. Ответственность Пользователей и Посетителей</h3>
                        <p>
                            Посетители самостоятельно несут ответственность за свои действия/бездействие при использовании Ресурса и Сервисов. Посетители гарантируют, что использование Ресурса и Сервисов, будет осуществляться таким образом, который не будет нарушать права третьих лиц. Посетители гарантируют, что обладают всеми правами на использование материалов, размещаемых ими на Сайте. Посетители обязуются соблюдать настоящую Публичную Оферту. При нарушении Посетителями Публичной Оферты Администрация оставляет за собой право временно ограничить доступ Посетителя к Сайту и Сервисам (временный бан), а в случае грубого и/или неоднократного нарушения Публичной Оферты отказать в доступе к Сервисам и Сайту (постоянный бан).
                        </p>
                        <h3>
                            4. Правила размещения и выполнения Заданий
                        </h3>
                        <p>
                            Пользователи могут размещать на сайте Задания. Запрещается размещение Заданий, целью которых является:
                        </p>
                        <ul>
                            <li>привлечение Пользователей на сторонние ресурсы, сайты, либо регистрация пользователей на таких ресурсах, сайтах;</li>
                            <li>реклама своих услуг и товаров или услуг и товаров, принадлежащих третьим лицам;</li>
                            <li>накрутка или изменение статистики сайтов, числа подписчиков в социальных сетях;</li>
                            <li>заказ автоматической или ручной рассылки приглашений и сообщений Пользователям социальных сетей, email-рассылок;</li>
                            <li>оказание услуг по распространению товаров Заказчика.</li>
                        </ul>
                        <p>
                            Размещение Задания осуществляется на безоплатной основе.
                        </p>
                        <p>Исполнители получают от Заказчиков Предложения посредством формы заявки. Предложение не является гарантией того, что Заказчик для выполнения своего задания выберет именно Исполнителя, разместившего предложение.</p>
                        <p> Заказчик осуществляет Выбор Исполнителя в сроки, определенные в момент создания Задания. После Выбора Исполнителя Сервис обеспечивает Заказчика и Исполнителя контактными данными друг друга, а именно телефонными номерами и электронными адресами, указанными Пользователями при регистрации.</p>
                        <p> С момента Выбора Исполнителя Заказчик и Исполнитель считаются заключившими между собой Договор на оказание услуг/выполнение работ.</p>
                        <p> Изменение условий Задания Заказчиком возможно только до Выбора Исполнителя. По факту выполнения своих обязательств по заключенному Договору Исполнитель при помощи Сервисов Сайта осуществляет заявку на перевод ему Суммы задания (только для Заданий с методом оплаты через систему).</p>
                        <p> Заказчик обязан подтвердить факт оказания услуг/выполнения работ по заключенному Договору, после чего Сумма Задания (если она была предварительно депонирована Заказчиком) переводится на счет Исполнителя (только для Заданий с методом оплаты через систему).</p>
                        <p>  Исполнителям запрещается перепоручать выполнение Заданий третьим лицам, в том числе своим супругам, детям, родственникам и друзьям.</p>
                        <h3>5. Правила размещения Объявлений</h3>
                        <p>
                            Пользователи могут размещать на сайте Объявления
                        </p>
                        <p>
                            Запрещается размещение объявлений:

                        <ul>
                            <li>нарушающих действующее законодательство Украины, нормы международного права;</li>
                            <li>содержащих рекламную информацию, спам, схемы финансовых “пирамид”;</li>
                            <li>являющихся незаконными, вредоносными, угрожающими, оскорбляющими нравственность, клеветническими, нарушающими авторские права либо другие права интеллектуальной собственности третьих лиц, пропагандирующими ненависть и/или дискриминацию людей по расовому, этническому, половому, социальному признакам;</li>
                            <li>содержащие ссылки на интернет сайты, Принадлежащие Пользователям или третьим лицам;</li>
                            <li>свои контактные данные (номер телефона, аккаунты социальных сетей или сервисов мгновенных сообщений;</li>
                            <li>нарушающих права третьих лиц;</li>
                            <li>не имеющих отношения к выбранной категории услуг.</li>
                        </ul>
                        </p>
                        <p>
                            Все объявления проходят предмодерацию и публикуются только после проверки Администрации. Опубликованне объявления в любой момент по усмотрению Администрации могут быть удалены без объяснения причин.
                        </p>
                        <h3>6. Сервис личных сообщений</h3>
                        <p>Пользователю предоставляется доступ к Сервису личных сообщений. Под Сервисом личных сообщений подразумевается возможность размещения Пользователем на страницах Сайта сообщений, которые являются недоступными для обозрения всеми Пользователями и доступны только Заказчику Задания и Выбранному Исполнителю.</p>
                        <p>Запрещается размещение личных сообщений:
                        <ul>
                            <li>нарушающих действующее законодательство Украины, нормы международного права;</li>
                            <li>содержащих рекламную информацию, спам, схемы финансовых “пирамид”;</li>
                            <li>являющихся незаконными, вредоносными, угрожающими, оскорбляющими нравственность, клеветническими, нарушающими авторские права либо другие права интеллектуальной собственности третьих лиц, пропагандирующими ненависть и/или дискриминацию людей по расовому, этническому, половому, социальному признакам;</li>
                            <li>содержащие ссылки на интернет сайты, Принадлежащие Пользователям или третьим лицам;</li>
                            <li>свои контактные данные (номер телефона, аккаунты социальных сетей или сервисов мгновенных сообщений;</li>
                            <li>нарушающих права третьих лиц.</li>
                        </ul>
                        </p>
                        <p>Администрация имеет право ознакомления с историей личных сообщений и в любой момент удалить личное сообщение, как соответствующее Публичной Оферте, так и нарушающее Публичную Оферту. Пользователь, нарушающий Публичную Оферту, может получить “бан” на постоянной или временной основе.</p>
                        <h3>Суд Сервиса</h3>
                        <p>В случае возникновения споров между Заказчиком и Исполнителем по исполнению Заданий, они разрешаются Администрацией. Пользователи соглашаются с тем, что Администрация имеет право по результатам рассмотрения спорной ситуации осуществить любые необходимые действия, в том числе, но не ограничиваясь, переводом Суммы Задания в Кошелек Исполнителя или Заказчика. Решение Администрации является окончательным и обжалованию не подлежит.</p>
                        <h3>Особые условия</h3>
                        <p>
                            Ресурс не гарантирует, что программное обеспечение Сервисов, Сайта не содержит ошибок или будет функционировать бесперебойно.
                            Ресурс не несет никакой ответственности за решения, принятые Администрацией при разрешении конфликтных ситуаций между Пользователями, в том числе по вынесенным вердиктам.
                            Ресурс не несет ответственности за убытки или иной вред, возникший у Пользователя в связи с действиями третьих лиц.
                            Ресурс оставляет за собой право удалять со своих серверов любую информацию или материалы, которые, по мнению Ресурса, являются неприемлемыми, нежелательными или нарушающими настоящую Публичную Оферту.
                            Ресурс не контролирует информацию, услуги и продукты, находящиеся в или предлагаемые посредством сети Интернет. Вследствие этого Пользователь принимает условие, в соответствии с которым все товары, информация и услуги, предлагаемые или доступные через Сервис или в сети Интернет (за исключением явно указанных как предоставляемые непосредственно Ресурсом), предоставляются третьими сторонами, которые никак не связаны с Ресурсом. Пользователь принимает на себя полную ответственность и риски за использование Сервисов и сети Интернет. Ресурс не предоставляет никаких гарантий на любые товары, информацию и услуги, поставляемые посредством Сервисов или через сеть Интернет вообще. Ресурс не будет нести ответственности за любые затраты или ущерб, прямо или косвенно возникшие в результате подобных поставок работ/услуг. Пользователь принимает условие, согласно которому он принимает на себя ответственность за оценку точности, полноты и пригодности всех мнений, оценок, услуг и другой информации, качества и функций товаров, предоставляемых посредством Сервисов или сети Интернет вообще.
                            Пользователь уведомлен и соглашается с тем, что при размещении Заданий, каждое Задание снабжается логотипом (товарным знаком) Ресурса, что обусловлено функционалом Сервиса.
                            Ресурс, при наличии возможности, обеспечивает размещение Заданий, представленных Пользователями, в СМИ, Интернет-ресурсах третьих лиц, книгах, сборниках, журналах, рекламных материалах Ресурса.
                        </p>
                        <h3>Вступление в силу и порядок изменения настоящей Публичной Оферты</h3>
                        <p>
                            Публичная Оферта и все изменения к ней вступают в силу с момента их опубликования на страницах Сайта. Изменения в Публичной Оферте могут быть внесены в любое время. Пользователь и/или Посетитель обязуется знакомиться с актуальной версией Публичной Оферты перед каждым использованием Ресурса, Сервисов и/или Услуг Сайта. Если Пользователь и/или Посетитель примет решение не соглашаться с измененной Публичной Офертой, то он обязан отказаться от использования Сервиса.
                            Пользователь, продолжающий пользование Ресурсом, Сервисами и/или услугами Сайта, соглашается с изменениями.
                        </p>
                        <h3>Применимое законодательство</h3>
                        <p>
                            Все взаимоотношения между Ресурсом и Посетителями подлежат регулированию исключительно законодательством Украины. При нарушении законодательства Украины Посетитель несет полную административную и уголовную гражданско-правовую ответственность.
                        </p>
            </div>
        </div>
    </div>
</div>


<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89816712-2', 'auto');
    ga('send', 'pageview');

</script>