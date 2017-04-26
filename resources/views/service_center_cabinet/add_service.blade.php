@extends('service_center_cabinet.layouts.master')

@section('content')
    <div flex layout="column" ng-controller="AddScController">
        <form name="scForm" flex layout="row" novalidate>
            <div flex layout="column" layout-padding>
                <md-input-container class="md-block">
                    <label>Название сервисного центра</label>
                    <input required name="name" ng-model="sc.name">
                    <div ng-messages="scForm.name.$error">
                        <div ng-message="required">Это поле обязательное для ввода</div>
                    </div>
                </md-input-container>

                <div layout="row">
                    <md-input-container flex>
                        <label>Город</label>
                        <md-select name="city" ng-model="sc.city" required>
                            <md-option ng-if="$index == 0" ng-repeat="item in cities"
                                       value="@{{item.id}}">@{{ item.city_name }}</md-option>
                        </md-select>
                        <div ng-messages="scForm.city.$error">
                            <div ng-message="required">Это поле обязательное для ввода.</div>
                        </div>
                    </md-input-container>
                    <md-input-container flex>
                        <label>Район</label>
                        <md-select name="district" ng-model="sc.district" required>
                            <md-option ng-repeat="item in districts"
                                       value="@{{item.id}}">@{{ item.address }}</md-option>
                        </md-select>
                        <div ng-messages="scForm.district.$error">
                            <div ng-message="required">Это поле обязательное для ввода.</div>
                        </div>
                    </md-input-container>

                </div>

                <div layout="row">

                    <md-input-container flex-gt-xs="50" class="md-block">
                        <label>Метро</label>
                        <md-select name="metro" ng-model="sc.metro" required>
                            <md-option ng-repeat="item in metro"
                                       value="@{{item.id}}">@{{ item.address }}</md-option>
                        </md-select>
                        <div ng-messages="scForm.metro.$error">
                            <div ng-message="required">Это поле обязательное для ввода. Выберите ближайшее метро</div>
                        </div>
                    </md-input-container>
                    <md-autocomplete md-no-cache="true"
                                     flex required
                                     md-input-name="street"
                                     md-floating-label="Улица, площадь, шоссе.."
                                     md-selected-item="selectStreet"
                                     md-min-length="1"
                                     md-selected-item-change="selectedStreet(selectStreet)"
                                     md-items="item in streets | filter: {'address': searchText}"
                                     md-search-text="searchText"
                                     md-item-text="item.address">
                        <span>@{{ item.address }}</span>
                    </md-autocomplete>

                </div>
                <div flex></div>
                <div layout="row">
                    <span flex></span>
                    <md-button type="submit" ng-click="addSc(scForm.$valid, sc)" class="md-primary
                    md-raised
                    md-fab-bottom-right">Добавить</md-button>
                </div>

            </div>
            <div flex layout="column">
                <div class="md-warn" ng-if="sc.c1 && sc.c2">Переместите маркер для точного местоположения</div>
                <ng-map id="map"
                        style="height: 100%"
                        center="@{{sc.c1 && sc.c2 ? sc.c1 +','+ sc.c2 : [48.475808, 35.018782]}}"
                        zoom="14">

                    <marker draggable="true"
                            on-dragend="dragMap()"
                            position="@{{sc.c1 +','+ sc.c2}}"
                            icon="{url:'/site/img/marker-map.png'}"></marker>
                </ng-map>
            </div>

        </form>
    </div>



@endsection
