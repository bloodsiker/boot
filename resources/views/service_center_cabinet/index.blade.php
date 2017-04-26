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
                                        <div>
                                            <img class="sc-logo" ng-src="@{{sc.logo ? '/site/img/'+sc.logo : 'http://fakeimg.pl/300/'}}" alt="@{{sc.service_name}}">
                                        </div>
                                        <input type="file" ng-model="scLogo" accept="image/*" base-sixty-four-input>
                                    </div>

                                </div>

                                <div layout="row">
                                    <md-input-container flex>
                                        <label>Город</label>
                                        <md-select name="city" ng-model="sc.city_id" required>
                                            <md-option ng-if="$index == 0" ng-repeat="item in cities"
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
                                                     md-selected-item-change="selectedStreet(selectStreet)"
                                                     md-items="item in streets | filter: {'address': searchText} "
                                                     md-search-text="searchText"
                                                     md-item-text="item.address">
                                        <span>@{{ item.address }}</span>
                                    </md-autocomplete>

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

                <md-content class="md-padding" flex layout="column">
                    <h1 class="md-display-1">Фотографии, сертификаты и лицензии</h1>
                    <div layout="row" layout-wrap flex>
                        <md-card flex="20" ng-repeat="item in sc.service_photo">
                            <img ng-src="@{{item.file_name}}"
                                 class="md-card-image"
                                 alt="@{{'Фото ' + sc.service_name}}">
                            <md-card-footer>
                                <div layout="row">
                                    Фото
                                    <span flex></span>
                                    <md-button class="md-icon-button" ng-click="deletePhoto(sc, sc.service_photo,
                                    $index)">
                                        <md-icon>delete</md-icon>
                                    </md-button>
                                    <md-button class="md-icon-button" ng-click="showPhoto($event, item.file_name)">
                                        <md-icon>zoom_in</md-icon>
                                    </md-button>
                                </div>
                            </md-card-footer>
                        </md-card>
                    </div>
                    <md-divider></md-divider>
                    <div layout="row" layout-wrap flex>
                        <md-card flex="20" ng-repeat="item in sc.licenses">
                            <img ng-src="@{{item.file_name}}"
                                 class="md-card-image"
                                 alt="@{{'Лицензия '+sc.service_name}}">
                            <md-card-footer>
                                <div layout="row">
                                    Лицензия
                                    <span flex></span>
                                    <md-button class="md-icon-button" ng-click="deletePhoto(sc, sc.licenses, $index)">
                                        <md-icon>delete</md-icon>
                                    </md-button>
                                    <md-button class="md-icon-button" ng-click="showPhoto($event, item.file_name)">
                                        <md-icon>zoom_in</md-icon>
                                    </md-button>
                                </div>
                            </md-card-footer>
                        </md-card>
                    </div>
                    <md-divider></md-divider>
                    <div layout="row" layout-wrap flex>
                        <md-card flex="20" ng-repeat="item in sc.certificate">
                            <img ng-src="@{{item.file_name}}"
                                 class="md-card-image"
                                 alt="@{{'Сертификат '+sc.service_name}}">
                            <md-card-footer>
                                <div layout="row">
                                    Сертификат
                                    <span flex></span>
                                    <md-button class="md-icon-button" ng-click="deletePhoto(sc.id, sc.certificate, $index)">
                                        <md-icon>delete</md-icon>
                                    </md-button>
                                    <md-button class="md-icon-button" ng-click="showPhoto($event, item.file_name)">
                                        <md-icon>zoom_in</md-icon>
                                    </md-button>
                                </div>
                            </md-card-footer>
                        </md-card>
                    </div>
                    <md-button class="md-fab md-fab-top-right" ng-click="addPhotoDialog($event, sc.id)">
                        <md-icon>add</md-icon>
                    </md-button>
                </md-content>

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
                            <form name="scForm" flex layout="column" novalidate>
                                <md-list>
                                    <md-list-item ng-repeat="item in sc.price" layout="row">
                                        <md-input-container flex>
                                            <input type="text" placeholder="Название" ng-model="item.title" required>
                                        </md-input-container>
                                        <span flex></span>
                                        <md-input-container class="md-block">
                                            <input type="number" placeholder="Цена" step="0.01" ng-model="item.price"
                                                   required>
                                        </md-input-container>
                                        <md-button type="button" ng-click="deletePrice(sc, $index)"
                                                   class="md-icon-button">
                                            <md-icon>delete</md-icon>
                                        </md-button>
                                    </md-list-item>


                                    <md-list-item ng-show="showAddPrice" layout="row">
                                        <div flex layout="column">
                                            <div layout="row">
                                                <md-input-container flex>
                                                    <input type="text" placeholder="Название" ng-model="newPriceTitle" required>
                                                </md-input-container>
                                                <span flex></span>
                                                <md-input-container class="md-block">
                                                    <input type="number" placeholder="Цена" step="0.01" ng-model="newPriceCost"
                                                           required>
                                                </md-input-container>
                                            </div>
                                            <div layout="row">
                                                <span flex></span>
                                                <md-button type="button" ng-click="addPrice(scForm.$valid, sc, newPriceTitle,newPriceCost)" class="md-primary md-raised">
                                                    Добавить
                                                </md-button>
                                            </div>
                                        </div>

                                    </md-list-item>

                                </md-list>
                                <div flex></div>
                                <div layout="row">
                                    <span flex></span>
                                    <md-button type="submit" ng-click="saveSc(scForm.$valid, sc)" class="md-primary
                                    md-raised">Сохранить
                                    </md-button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <md-button class="md-fab md-fab-top-right" ng-click="showAddPrice = true">
                        <md-icon>add</md-icon>
                    </md-button>

                </md-content>
            </md-tab>

            <md-tab label="Команда сервиса">

                <md-content class="md-padding" flex layout="column">
                    <h1 class="md-display-1">Команда сервиса</h1>
                    <div layout="row" layout-wrap flex>
                        <md-card flex="20" ng-repeat="item in sc.personal">
                            <img ng-src="@{{item.avatar}}"
                                 class="md-card-image"
                                 alt="@{{item.name}}">

                            <md-card-title>
                                <md-card-title-text>
                                    <span class="md-headline">@{{ item.name }}</span>
                                    <span class="md-subhead">@{{ item.info }}</span>
                                </md-card-title-text>
                            </md-card-title>
                            <md-card-actions layout="row" layout-align="end center">
                                <md-button ng-click="deletePersonal(sc, $index)">Удалить</md-button>
                            </md-card-actions>
                        </md-card>
                    </div>
                    <md-button class="md-fab md-fab-top-right" ng-click="addPersonalDialog($event, sc.id)">
                        <md-icon>add</md-icon>
                    </md-button>
                </md-content>

            </md-tab>
        </md-tabs>
    </div>




@endsection
