@extends('service_center_cabinet.layouts.master')

@section('content')
    <div flex layout="column" data-ng-controller="RefactorScController">
        <md-tabs flex layout="column" layout-fill md-border-bottom>
            <md-tab label="Основное" flex layout="column">
                <md-content layout-fill flex layout="column">
                    <div flex layout="row">
                        <div flex layout="column" layout-padding>
                            <form name="ReqForm" flex layout="column" novalidate>

                                <div layout="row">
                                    <md-input-container flex>
                                        <label>Название сервисного центра</label>
                                        <input required name="name" ng-model="sc.service_name">
                                        <div ng-messages="ReqForm.name.$error">
                                            <div ng-message="required">Это поле обязательное для ввода</div>
                                        </div>
                                    </md-input-container>
                                    <div layout="column" layout-padding>
                                        <label for="logoSc">
                                            <div style="max-width: 200px; cursor: pointer; position: relative;">
                                                <img ng-if="!scLogo" class="sc-logo" ng-src="@{{sc.logo ? sc.logo : 'http://fakeimg.pl/200x100/'}}" alt="@{{sc.service_name}}">
                                                <img ng-if="scLogo" class="sc-logo" ng-src="@{{'data:'+scLogo.filetype+';base64,'+scLogo.base64}}" alt="@{{sc.service_name}}">
                                                <span style="position: absolute; bottom: 8px; right: 5px;"><md-icon>add_a_photo</md-icon></span>
                                            </div>

                                        </label>
                                        <input type="file" ng-hide="true" id="logoSc" ng-model="scLogo" accept="image/*" base-sixty-four-input>
                                        <div layout="row"  layout-sm="column" ng-show="scLogo && visibleSaveLogo">
                                            <md-button class="md-primary md-mini md-raised" ng-click="scLogo = null">Отмена</md-button>
                                            <md-button class="md-primary md-mini md-raised " ng-click="addLogo(scLogo)">Сохранить</md-button>
                                        </div>

                                    </div>

                                </div>

                                <div layout="row">
                                    <md-input-container flex>
                                        <label>Город</label>
                                        <md-select name="city" ng-model="sc.city_id" required>
                                            <md-option ng-if="item.id == 1" ng-repeat="item in cities"
                                                       value="@{{item.id}}">@{{ item.city_name }}</md-option>
                                        </md-select>
                                        <div ng-messages="ReqForm.city.$error">
                                            <div ng-message="required">Это поле обязательное для ввода.</div>
                                        </div>
                                    </md-input-container>
                                    <md-input-container flex>
                                        <label>Район</label>
                                        <md-select name="district" ng-model="sc.district_id" required>
                                            <md-option ng-repeat="item in districts"
                                                       value="@{{item.id}}">@{{ item.address }}</md-option>
                                        </md-select>
                                        <div ng-messages="ReqForm.district.$error">
                                            <div ng-message="required">Это поле обязательное для ввода.</div>
                                        </div>
                                    </md-input-container>

                                </div>

                                <div layout="row">

                                    <md-input-container flex-gt-xs="50" class="md-block">
                                        <label>Метро</label>
                                        <md-select name="metro" ng-model="sc.metro_id" required>
                                            <md-option ng-repeat="item in metro"
                                                       value="@{{item.id}}">@{{ item.address }}</md-option>
                                        </md-select>
                                        <div ng-messages="ReqForm.metro.$error">
                                            <div ng-message="required">Это поле обязательное для ввода. Выберите
                                                ближайшее метро
                                            </div>
                                        </div>
                                    </md-input-container>
                                    <md-autocomplete md-no-cache="true"
                                                     flex required
                                                     md-input-name="street"
                                                     md-floating-label="Улица, площадь, шоссе.."
                                                     md-selected-item="sc.street"
                                                     md-min-length="1"
                                                     md-selected-item-change="selectedStreet(item)"
                                                     md-items="item in streets | filter: {'address': searchText} "
                                                     md-search-text="searchText"
                                                     md-item-text="item.address">
                                        <span>@{{ item.address }}</span>
                                    </md-autocomplete>
                                    <md-input-container flex-gt-xs="10" class="md-block">
                                        <label>Номер</label>
                                        <input type="text" ng-change="changeNumberH($event)" ng-model="sc.number_h">
                                    </md-input-container>


                                </div>

                                <div layout="row" layout-align="end center" ng-repeat="day in sc.work_days track by $index">
                                    <md-input-container flex-gt-xs="10" class="md-block">
                                        <input type="text" ng-model="day.title" disabled>
                                    </md-input-container>
                                    <md-input-container flex-gt-xs="25" class="md-block">
                                        <label>Начало дня</label>
                                        <md-select name="start_time" ng-model="day.start_time">
                                            <md-option ng-repeat="time in times_start"
                                                       value="@{{time}}">@{{ time }}</md-option>
                                        </md-select>
                                    </md-input-container>
                                    <md-input-container flex-gt-xs="25" class="md-block">
                                        <label>Конец дня</label>
                                        <md-select name="end_time" ng-model="day.end_time">
                                            <md-option ng-repeat="time in times_end"
                                                       value="@{{time}}">@{{ time }}</md-option>
                                        </md-select>
                                    </md-input-container>
                                    <md-checkbox flex ng-model="day.weekend" ng-true-value="'1'" ng-false-value="'0'">Выходной</md-checkbox>

                                </div>
                                <div flex></div>
                                <div layout="row">
                                    <span flex></span>
                                    <md-button type="submit" ng-click="saveSc(ReqForm.$valid, sc)" class="md-primary
                                    md-raised md-fab-bottom-right">Сохранить
                                    </md-button>
                                </div>
                            </form>
                        </div>
                        <div flex layout="column">
                            <div class="md-warn" ng-if="sc.c1 && sc.c2">Переместите маркер для точного местоположения
                            </div>
                            <ng-map id="map"
                                    style="height: 100%"
                                    center="@{{sc.c1 +','+ sc.c2}}"
                                    zoom="14">

                                <marker draggable="true"
                                        on-dragend="dragMap()"
                                        position="@{{sc.c1 +','+ sc.c2}}"
                                        icon="{url:'/site/img/marker-map.png'}"></marker>
                            </ng-map>
                        </div>
                    </div>

                </md-content>
            </md-tab>
            <md-tab label="Преимущества" flex layout="column">
                <md-content layout-fill flex layout="column">
                    <div flex layout="row">
                        <div flex layout="column" layout-padding>
                            <form name="scForm" flex layout="column" novalidate>
                                <div layout="row">
                                    <div flex layout-padding class="md-block">
                                        <label>Преимущества</label>
                                        <md-chips ng-model="sc.advantages"
                                                  name="advantages"
                                                  md-transform-chip="addAdvantages($chip, sc.id)"
                                                  placeholder='Добавить преимущество... (напр. "Прозрачная ценовая политика")'>
                                            <md-chip-template>
                                                <strong>@{{$chip.advantages}}</strong>
                                            </md-chip-template>
                                        </md-chips>
                                    </div>
                                    <div flex layout-padding class="md-block">
                                        <label>Теги</label>
                                        <md-chips ng-model="sc.tags"
                                                  name="tags"
                                                  md-transform-chip="addTags($chip, sc.id)"
                                                  placeholder='Добавить тег... (напр. "Выезд мастера")'>
                                            <md-chip-template>
                                                <strong>@{{$chip.tag}}</strong>
                                            </md-chip-template>
                                        </md-chips>
                                    </div>
                                </div>
                                <div flex></div>
                                <div layout="row">
                                    <span flex></span>
                                    <md-button type="submit" ng-click="saveSc(true)" class="md-primary
                                    md-raised">Сохранить
                                    </md-button>
                                </div>
                            </form>
                        </div>
                    </div>

                </md-content>
            </md-tab>
            <md-tab label="Бренды" flex layout="column">
                <md-content layout-fill flex layout="column">
                    <div flex layout="row">
                        <div flex layout="column" layout-padding>
                            <form name="scForm" flex layout="column" novalidate>
                                <div>
                                    <md-checkbox aria-label="Select All"
                                                 ng-checked="isChecked()"
                                                 md-indeterminate="isIndeterminate()"
                                                 ng-click="toggleAll()">
                                        <span ng-if="isChecked()">Снять отметки</span>
                                        <span ng-if="!isChecked()">Выбрать все</span>
                                    </md-checkbox>
                                </div>
                                <div layout="row" layout-wrap flex>
                                    <div flex="30" ng-repeat="item in items track by $index">
                                        <md-checkbox ng-checked="exists(item, selected)"
                                                     ng-click="toggle(item, selected)">
                                            @{{ item.manufacturer }}
                                        </md-checkbox>
                                    </div>
                                </div>
                                <div flex></div>
                                <div layout="row">
                                    <span flex></span>
                                    <md-button type="submit" ng-click="saveSc(true)" class="md-primary
                                    md-raised">Сохранить
                                    </md-button>
                                </div>
                            </form>
                        </div>
                    </div>

                </md-content>
            </md-tab>
            <md-tab label="Галерея">

                <md-content layout-fill flex>

                    <md-tabs layout-fill md-dynamic-height md-border-bottom>
                        <md-tab label="Фотографии">
                            <md-content layout-fill flex>
                                <div layout="row" class="md-padding" layout-wrap flex>
                                    <md-card ng-repeat="item in sc.service_photo" ng-if="item.type === 'service_photo'">
                                        <img ng-src="@{{item.path + item.file_name_mini}}"
                                             class="md-card-image"
                                             alt="@{{'Фото ' + sc.service_name}}">
                                        <md-card-footer>
                                            <div layout="row">
                                                <span flex></span>
                                                <md-button class="md-icon-button" ng-click="deletePhoto(sc.service_photo, item, $index)">
                                                    <md-icon>delete</md-icon>
                                                </md-button>
                                                <md-button class="md-icon-button" ng-click="showPhoto($event, item.path + item.file_name)">
                                                    <md-icon>zoom_in</md-icon>
                                                </md-button>
                                            </div>
                                        </md-card-footer>
                                    </md-card>
                                </div>
                            </md-content>
                        </md-tab>
                        <md-tab label="Cертификаты">
                            <md-content>
                                <div layout="row" class="md-padding" layout-wrap flex>
                                    <md-card ng-repeat="item in sc.service_photo" ng-if="item.type === 'certificate'">
                                        <img ng-src="@{{item.path + item.file_name_mini}}"
                                             class="md-card-image"
                                             alt="@{{'Фото ' + sc.service_name}}">
                                        <md-card-footer>
                                            <div layout="row">
                                                <span flex></span>
                                                <md-button class="md-icon-button" ng-click="deletePhoto(sc.service_photo, item, $index)">
                                                    <md-icon>delete</md-icon>
                                                </md-button>
                                                <md-button class="md-icon-button" ng-click="showPhoto($event, item.path + item.file_name)">
                                                    <md-icon>zoom_in</md-icon>
                                                </md-button>
                                            </div>
                                        </md-card-footer>
                                    </md-card>
                                </div>
                            </md-content>
                        </md-tab>
                        <md-tab label="Лицензии">
                            <md-content>
                                <div layout="row" class="md-padding" layout-wrap flex>
                                    <md-card ng-repeat="item in sc.service_photo" ng-if="item.type === 'licenses'">
                                        <img ng-src="@{{item.path + item.file_name_mini}}"
                                             class="md-card-image"
                                             alt="@{{'Фото ' + sc.service_name}}">
                                        <md-card-footer>
                                            <div layout="row">
                                                <span flex></span>
                                                <md-button class="md-icon-button" ng-click="deletePhoto(sc.service_photo, item, $index)">
                                                    <md-icon>delete</md-icon>
                                                </md-button>
                                                <md-button class="md-icon-button" ng-click="showPhoto($event, item.path + item.file_name)">
                                                    <md-icon>zoom_in</md-icon>
                                                </md-button>
                                            </div>
                                        </md-card-footer>
                                    </md-card>
                                </div>
                            </md-content>
                        </md-tab>
                    </md-tabs>
                </md-content>
                <md-button class="md-fab md-fab-bottom-right" ng-click="addPhotoDialog($event, sc)">
                    <md-icon>add</md-icon>
                </md-button>
            </md-tab>
            <md-tab label="О компании" flex layout="column">
                <md-content layout-fill flex layout="column">
                    <div flex layout="row">
                        <div flex layout="column" layout-padding>
                            <h1 class="md-display-1">О компании</h1>
                            <form name="aboutForm" flex layout="column" novalidate>
                                <div flex></div>
                                <div>
                                    <md-input-container class="md-block">
                                        <label>О компании</label>
                                        <textarea name="about" ng-model="sc.about"></textarea>
                                    </md-input-container>
                                </div>
                                <div layout="row">
                                    <span flex></span>
                                    <md-button type="submit" ng-click="saveSc(aboutForm.$valid, sc)" class="md-primary
                                    md-raised">Сохранить
                                    </md-button>
                                </div>
                            </form>
                        </div>
                    </div>

                </md-content>
            </md-tab>
            <md-tab label="Цены" flex layout="column">
                <md-content layout-fill flex layout="column">
                    <div flex layout="row">
                        <div flex layout="column" layout-padding>
                            <h1 class="md-display-1">Примерная стоимость работ</h1>
                                <md-list>
                                    <md-list-item ng-repeat="price in price_list" layout="row">
                                        <p ng-bind="price.title"></p>
                                        <md-input-container class="md-block">
                                            <input type="number" placeholder="Цена" number-to-string ng-model="price.price" step="0.01" >
                                        </md-input-container>
                                        <md-input-container flex="10" class="md-block">
                                            <label>Валюта</label>
                                            <md-select name="currency" ng-model="price.currency">
                                                <md-option ng-repeat="time in currency" value="@{{time}}">@{{ time }}</md-option>
                                            </md-select>
                                        </md-input-container>
                                    </md-list-item>


                                    <md-list-item layout="row">
                                        <form name="addPriceForm" flex layout="row" layout-align="end end" novalidate>
                                            <md-input-container flex>
                                                <input type="text" placeholder="Добавить услугу" ng-model="newPriceTitle" required>
                                            </md-input-container>
                                            <span flex></span>
                                            <md-input-container class="md-block">
                                                <input type="number" placeholder="Цена" step="0.01" ng-model="newPriceCost" required>
                                            </md-input-container>
                                            <md-input-container flex="10" class="md-block">
                                                <label>Валюта</label>
                                                <md-select name="currency" ng-model="newPriceCurrency">
                                                    <md-option ng-selected="@{{$first}}" ng-repeat="time in currency" value="@{{time}}">@{{ time }}</md-option>
                                                </md-select>
                                            </md-input-container>
                                            <md-button type="button" ng-click="addPrice(addPriceForm.$valid, sc, newPriceTitle, newPriceCost, newPriceCurrency)" class="md-primary md-raised">
                                                Добавить
                                            </md-button>
                                        </form>
                                    </md-list-item>
                                </md-list>
                                <div flex></div>
                                <div layout="row">
                                    <span flex></span>
                                    <md-button type="submit" ng-click="saveScPrice(true, price_list)" class="md-primary
                                    md-raised">Сохранить
                                    </md-button>
                                </div>
                        </div>
                    </div>
                </md-content>
            </md-tab>

            <md-tab label="Команда сервиса">

                <md-content class="md-padding" flex layout="column">
                    <h1 class="md-display-1">Команда сервиса</h1>
                    <div layout="row" layout-wrap flex>
                        <md-card flex="20" class="delete-animate" ng-repeat="item in sc.personal">
                            <img ng-src="@{{item.path + item.avatar}}"
                                 class="md-card-image"
                                 alt="@{{item.name}}">

                            <md-card-title>
                                <md-card-title-text>
                                    <span class="md-headline">@{{ item.name }}</span>
                                    <span class="md-subhead">@{{ item.info }}</span>
                                </md-card-title-text>
                            </md-card-title>
                            <md-card-actions layout="row" layout-align="end center">
                                <md-button ng-click="deletePersonal(sc, $index, item)">Удалить</md-button>
                            </md-card-actions>
                        </md-card>
                    </div>
                    <md-button class="md-fab md-fab-top-right" ng-click="addPersonalDialog($event, sc)">
                        <md-icon>add</md-icon>
                    </md-button>
                </md-content>

            </md-tab>
        </md-tabs>
    </div>



    <script type="text/ng-template" id="addGallery.html">

    <md-dialog aria-label="Добавить фото">
        <md-dialog-content layout-padding>
             <form name="adPhotoForm" novalidate>
                 <label style="cursor: pointer; position: relative;">
                     <img src="http://fakeimg.pl/300x300/?text=Foto" alt="add personal" >
                     <span style="position: absolute; bottom: 8px; right: 5px;"><md-icon>add_a_photo</md-icon></span>
                     <input type="file" ng-hide="true" accept="image/*" aria-label="Фото" ng-model="file" base-sixty-four-input required>
                 </label>
                 <md-select ng-model="type" aria-label="Тип фото" required>
                                       <md-option selected value="service_photo">Фото</md-option>
                                      <md-option value="certificate">Сертификат</md-option>
                                      <md-option value="licenses">Лицензия</md-option>
                              </md-select>

                     <div layout="row">
                            <md-button aria-label="Добавить фото" type="submit" ng-click="closeDialog()">Отмена</md-button>
                    <span flex></span>
                           <md-button aria-label="Добавить фото" type="submit" ng-click="addPhoto(adPhotoForm.$valid, type, file)">Добавить</md-button>
                           </div>
                      </form>
              </md-dialog-content>
        </md-dialog>

    </script>

    <script type="text/ng-template" id="addPersonal.html">
        <md-dialog aria-label="Добавить фото">
            <md-dialog-content layout-padding layout="column">
                 <form name="newPersonalForm" novalidate>
                     <label style="cursor: pointer; position: relative;">
                         <img src="http://fakeimg.pl/300x300/" alt="add personal">
                         <span style="position: absolute; bottom: 8px; right: 5px;"><md-icon>add_a_photo</md-icon></span>
                         <input type="file" ng-hide="true" accept="image/*" aria-label="Фото" ng-model="newPersonalPhoto" base-sixty-four-input required>
                     </label>


                    <md-input-container class="md-block">
                        <input type="text" ng-model="newPersonalName" placeholder="ФИО" required>
                    </md-input-container>
                    <md-input-container class="md-block">
                        <input type="text" ng-model="newPersonalInfo" placeholder="Должность">
                    </md-input-container>
                     <md-input-container class="md-block">
                        <input type="text" ng-model="newPersonalWorkExp" placeholder="Специализация">
                    </md-input-container>
                     <md-input-container class="md-block">
                        <input type="text" ng-model="newPersonalSpecialization" placeholder="Опыт работы">
                    </md-input-container>
                         <div layout="row">
                                <md-button aria-label="Добавить фото" type="submit" ng-click="closeDialog()">Отмена</md-button>
                           <span flex></span>
                            <md-button type="submit" ng-click="addPersonal(newPersonalForm.$valid, newPersonalName, newPersonalInfo, newPersonalWorkExp, newPersonalSpecialization,  newPersonalPhoto)">
                               Добавить
                           </md-button>
                     </div>
                </form>
                </md-dialog-content>
            </md-dialog>
    </script>



@endsection
