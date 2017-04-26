<!--============== FOOTER =========================-->

<hr>
<div class="container">
    <div class="row footer">
        <div class="col-md-2">
            <img src="{{ asset('site/img/logo.png') }}" alt="boot">
            <br>
            <span>© 2017 Fix.me. <br>
             Все права защищены.</span>
        </div>
        <div class="col-md-3">
            <ul>
                <li><a href="{{ route('about') }} " class="{{ active('about') }}">О проекте</a></li>
                <li><a data-toggle="modal" data-target="#terms_modal">Пользовательское соглашение</a></li>
                <li><a href="{{ route('catalog') }}" class="{{ active('catalog') }}">Каталог сервис-центров</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul>
                <li><a href="{{ route('diagnostics') }} " class="{{ active('diagnostics') }}">Диагностика</a></li>
                <li><a data-toggle="modal" data-target="#help_modal">Помощь в подборе</a></li>
                <li><a href="{{ route('service.registration') }}">Регистрация сервис-центров</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li><a href="tel:0 800 256-357" class="phone"><i class="glyphicon glyphicon-phone"></i> 0 800
                        256-357</a> <span>Звонки по Украине бесплатны</span></li>
                <li><a href="mailTo:Support@fix.com" class="mail"><i class="glyphicon glyphicon-send"></i>
                        Support@fix.com</a></li>
                <li><span class="time"><i class="glyphicon glyphicon-time"></i> Пн — Пт: c 9:00 до 18:00</span></li>
            </ul>
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
                        <div class="col-md-4">
                            <img class="avatar" src="http://fakeimg.pl/350x200/?text=Photo" alt="client-user">
                            <h4 class="name">
                                <input type="text"
                                       ng-minlength="2"
                                       required
                                       ng-class="{'input-error': add_comment.user_name.length == 0 && add_comment_valid}"
                                       ng-model="add_comment.user_name" placeholder="Иванов Иван Иванович"
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
                        <div class="col-md-8">
                            <textarea autofocus
                                      ng-class="{'input-error': add_comment.text.length == 0 && add_comment_valid}"
                                      class="add-comment-text " ng-model="add_comment.text"
                                      name="add_comment_text"
                                      placeholder="Оставьте здесь свой комментарий..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-warning" ng-click="add_comment_btn(add_comment_form.$valid, add_comment)">Добавить</button>
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
                <h4>Комментарий добавлен</h4>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 100%;" class="btn btn-danger" data-dismiss="modal">Понятно!</button>
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
                <button type="button" style="width: 100%;" class="btn btn-danger" data-dismiss="modal">Понятно!</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
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
                                   ng-model="client_name">
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="text"
                                   pattern="^(?:0|\(?\+380\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$"
                                   class="form-control"
                                   required
                                   placeholder="Введите телефон"
                                   name="client_phone"
                                   ng-model="client_phone">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-warning" ng-click="helpCall(help_form.$valid, client_name, client_phone)">
                        Связаться
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--==============MODAL CALL US=========================-->


<div class="modal fade" id="call_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form name="call_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Связаться</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="client_name">Имя</label>
                        <input type="text" id="client_name" class="form-control" placeholder="Введите имя"
                               name="client_name" required ng-model="client_name">
                    </div>
                    <div class="form-group">
                        <label for="client_phone">Телефон</label>
                        <input type="text" id="client_phone" pattern="^(?:0|\(?\+380\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" class="form-control" placeholder="Введите телефон"
                               name="client_phone" required ng-model="client_phone">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-warning" ng-click="scCall(call_form.$valid, client_name,
                    client_phone, call_sc)">
                        Связаться
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--==============MODAL TERMS=========================-->

<div class="modal fade" id="terms_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Пользовательское соглашение</h4>
            </div>
            <div class="modal-body">
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem, esse ex natus non sit velit? Exercitationem necessitatibus odio sint sunt ut? Accusantium dolor fugiat nostrum similique! Blanditiis, enim, reprehenderit!</span><span>Adipisci animi architecto autem debitis delectus, deserunt dolorem et excepturi in itaque mollitia obcaecati odit, officia porro quaerat quam qui quidem quos saepe tempore ullam vero vitae voluptatem. Ea, suscipit!</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad commodi consequatur cumque inventore ipsam, iure iusto officiis optio possimus quas repellendus suscipit tempore vitae voluptatem? Libero quos ut vitae.</span><span>Consequuntur corporis cupiditate doloribus error et excepturi id itaque, minima mollitia nihil nisi, obcaecati odit optio placeat quas quasi qui, rerum sequi tempore voluptates. Illo maxime molestias possimus quas repudiandae?</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, impedit ipsa iusto nihil quidem repellendus sequi ullam! Accusantium at distinctio eveniet explicabo, fugit id ipsa, minus possimus repellendus, soluta totam.</span><span>Delectus esse itaque maiores modi molestiae mollitia natus quae sunt, veritatis vero. Explicabo iste nostrum officiis quis ratione rerum saepe voluptatem. Officiis placeat quam quibusdam veritatis. Blanditiis dolorem officia sit!</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur, at hic officia quam rem rerum sunt? Atque nihil quia quos sed tenetur. Asperiores aut culpa excepturi fuga quibusdam rerum!</span><span>A aliquam assumenda commodi consequatur cumque dolor dolorem doloribus excepturi fugit ipsa minima nobis numquam odio perferendis perspiciatis possimus quae, quia repellendus repudiandae rerum sed sequi sit temporibus tenetur ullam.</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, repellendus, tempora? A amet, consequuntur magnam non officia repellat sint suscipit vitae. Aliquam aliquid, atque dolorum ipsa modi necessitatibus repellat voluptatem.</span><span>Ab consectetur id illo incidunt iure labore odit, pariatur quam quos similique? Alias atque culpa cumque, dicta id inventore nulla quam velit. Ad aliquid cumque earum ipsam, ipsum neque omnis?</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur cum magnam molestias nam praesentium, quasi quisquam recusandae sequi similique voluptates! Aspernatur consequatur, ex iste iure magni molestiae pariatur perferendis perspiciatis?</span><span>Adipisci amet assumenda, at aut consectetur debitis, deserunt doloremque fugiat, in ipsam iure perferendis porro quia quis repellat repellendus repudiandae rerum tempore ut vero. Deleniti dolorem impedit ipsum non provident!</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem blanditiis dolorem illo impedit qui voluptatum. Ex nihil, voluptas. Corporis distinctio ipsa iure, maxime molestiae non rem rerum sequi suscipit veritatis!</span><span>Delectus deleniti deserunt, dignissimos fugit impedit iure, magni obcaecati quas quia quod repellat reprehenderit rerum ullam vitae voluptatibus? Corporis dicta distinctio exercitationem harum, illum nam nihil perspiciatis recusandae unde voluptatem?</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aut consequuntur cumque distinctio excepturi explicabo harum id minus neque nulla quam quis repellat reprehenderit saepe sit, tempora, voluptatum. Blanditiis, quia.</span><span>Ab aspernatur dolores error eveniet expedita fugiat harum hic libero omnis porro quas, quia rerum sed tempore ut veritatis voluptates! Blanditiis hic illo in libero quasi quidem soluta temporibus, voluptatum!</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet commodi dolore eius est expedita hic nostrum officia, quisquam sint voluptate! Beatae cumque debitis enim mollitia nam. Autem labore odit vel.</span><span>Consectetur eaque iste itaque, iure provident sed suscipit! Aperiam consequuntur dolorem earum ipsum laboriosam magnam possimus quae quas quidem ut? Ab at consectetur debitis eos nobis optio ratione unde velit!</span>
                </p>
                <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt facere, voluptates. Amet architecto eos quasi quibusdam! Debitis doloribus enim eos maiores molestias nisi possimus quia sed. Nulla repellat sequi vero.</span><span>A ab aliquam asperiores at blanditiis corporis cupiditate deserunt dicta, dolor dolores ducimus earum eligendi est fugiat illo itaque molestias, necessitatibus, neque non obcaecati odio omnis perferendis qui repellendus suscipit!</span>
                </p>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
