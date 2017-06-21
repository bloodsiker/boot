@extends('service_center_cabinet.layouts.master')

@section('content')


    <div ng-controller="RefactorScController" ng-cloak>
        <section class="content-header">
            <h1 ng-bind="sc.service_name"></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Cервисный центр</li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">

                <div class="col-md-3">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Логотип</h3>
                        </div>
                        <div class="box-body">
                            <label for="logoSc">
                                <div style="cursor: pointer; position: relative;">
                                    <img ng-if="!scLogo" class="sc-logo" ng-src="@{{sc.logo ? sc.logo : 'http://fakeimg.pl/200x100/'}}" alt="@{{sc.service_name}}">
                                    <img ng-if="scLogo" class="sc-logo" ng-src="@{{'data:'+scLogo.filetype+';base64,'+scLogo.base64}}" alt="@{{sc.service_name}}">
                                    <span style="position: absolute; bottom: 8px; right: 5px;"><md-icon>add_a_photo</md-icon></span>


                                    <input type="file" ng-hide="true" id="logoSc" ng-model="scLogo" accept="image/*" base-sixty-four-input>

                                </div>

                            </label>
                        </div>

                        <div class="box-footer text-right" ng-show="scLogo && visibleSaveLogo">
                            <button type="button" class="btn btn-danger" ng-click="scLogo = null">Отмена</button>
                            <button type="button" class="btn btn-primary" ng-click="addLogo(scLogo)">Сохранить</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Главная информация</h3>
                        </div>

                        <form role="form" name="addForm" novalidate>
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-12 col-lg-9">
                                        <div class="form-group">
                                            <label>Название сервисного центра</label>
                                            <input type="text" ng-model="sc.name" class="form-control" placeholder="Название сервисного центра" required>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Город</label>
                                                    <select class="form-control" ng-model="sc.city" ng-options="city.city_name for city in cities track by city.id" required></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Район</label>
                                                    <select class="form-control" ng-model="sc.district" ng-options="district.address for district in districts track by district.id"></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group drop-street">
                                                    <label>Улица</label>

                                                    <input type="text"
                                                           class="form-control"
                                                           typeahead-on-select="selectedStreet($item)"
                                                           typeahead-show-hint="true"
                                                           typeahead-min-length="0"
                                                           placeholder="Искать улицу"
                                                           ng-model="street.address"
                                                           required
                                                           uib-typeahead="street as street.address for street in streets | filter:$viewValue | limitTo: 30">

                                                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Номер</label>
                                                    <input type="text" class="form-control" ng-change="changeNumberH($event)" ng-model="sc.number_h" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Метро</label>
                                                    <select class="form-control" ng-model="sc.metro" ng-options="metro.address for metro in metros track by metro.id"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Дополнительная информация (ТЦ Большевик, 2 этаж)</label>
                                                    <input type="text" class="form-control" ng-model="sc.number_h_add">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-3">
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

                            </div>


                            <div class="box-footer text-right">
                                <button type="button" class="btn btn-primary" ng-click="addSc(addForm.$valid, sc)">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="col-md-7">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border" >
                            <h3 class="box-title">График работы</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>День</th>
                                        <th>с</th>
                                        <th>по</th>
                                        <th>выходной</th>
                                    </tr>
                                    <tr ng-repeat="day in sc.work_days track by $index">
                                        <td ng-bind="day.title"></td>
                                        <td>
                                            <select class="form-control" ng-model="day.start_time" ng-options="time for time in times_start"></select>
                                        </td>
                                        <td>
                                            <select class="form-control" ng-model="day.end_time" ng-options="time for time in times_end"></select>
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" ng-model="day.weekend" ng-true-value="'1'" ng-false-value="'0'">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveSc(true)">Сохранить</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Преимущества</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">

                            <table class="table">
                                <tr ng-repeat="advantage in sc.advantages track by $index">
                                    <td ng-bind="advantage"></td>
                                    <td><i style="cursor: pointer;" ng-click="removeAdvantages($index)" class="fa fa-trash"></i></td>
                                </tr>
                            </table>

                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" ng-model="preAdvantage" placeholder='напр. "Прозрачная ценовая политика"'>
                                <span class="input-group-btn">
                                  <button type="button" ng-disabled="!preAdvantage" ng-click="addAdvantages(preAdvantage)"  class="btn btn-info btn-flat">добавить</button>
                                </span>
                            </div>

                        </div>

                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveSc(true)">Сохранить</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Теги</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">


                            <table class="table">
                                <tr ng-repeat="tag in sc.tags track by $index">
                                    <td ng-bind="tag"></td>
                                    <td><i style="cursor: pointer;" ng-click="removeTags($index)" class="fa fa-trash"></i></td>
                                </tr>
                            </table>

                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" ng-model="preTag" placeholder='напр. "Выезд мастера"'>
                                <span class="input-group-btn">
                                  <button type="button" ng-disabled="!preTag" ng-click="addTags(preTag)" class="btn btn-info btn-flat">добавить</button>
                                </span>
                            </div>


                        </div>

                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveSc(true)">Сохранить</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Бренды</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div>
                                <input type="checkbox" aria-label="Select All"
                                       ng-checked="isChecked()"
                                       md-indeterminate="isIndeterminate()"
                                       ng-click="toggleAll()">
                                <span ng-if="isChecked()">Снять отметки</span>
                                <span ng-if="!isChecked()">Выбрать все</span>

                            </div>
                            <div class="row">
                                <div class="col-xs-3" ng-repeat="item in items track by $index">
                                    <input type="checkbox" ng-checked="exists(item, selected)" ng-click="toggle(item, selected)"> @{{ item.manufacturer }}
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveSc(true)">Сохранить</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">

                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Виды и стоимость работ</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">

                            <table>
                                <tr ng-repeat="price in price_list" style="vertical-align: top;">
                                    <td>
                                        <input type="checkbox" ng-model="price.active" required>
                                    </td>
                                    <td ng-bind="price.title"></td>
                                    <td width="100">
                                        <input type="text" ng-class="{'error-input': price.price_min == 0 && price.active}" placeholder="цена от" number-to-string ng-model="price.price_min">
                                        <em ng-if="price.price_min == 0 && price.active" style="color: #F44336;">Введите цену</em>
                                        <em ng-if="showErrorPrice(price)" style="color: #F44336;">Введите корректную цену</em>
                                    </td>
                                    <td> - </td>
                                    <td width="100">
                                        <input type="text"  ng-class="{'error-input': price.price_max == 0 && price.active}" placeholder="цена до" number-to-string ng-model="price.price_max">
                                        <em ng-if="price.price_max == 0 && price.active" style="color: #F44336;">Введите цену</em>
                                    </td>
                                    <td>
                                        <select style="margin: 0;" ng-model="price.currency" ng-options="cur for cur in currency"></select>
                                    </td>
                                </tr>
                            </table>

                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" ng-model="preTag" placeholder='напр. "Выезд мастера"'>
                                <span class="input-group-btn">
                                  <button type="button" ng-disabled="!preTag" ng-click="addTags(preTag)" class="btn btn-info btn-flat">добавить</button>
                                </span>
                            </div>

                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveSc(true)">Сохранить</button>
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">О компании</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <textarea style="width:100%;" class="aboutSc" name="about" ng-model="sc.about"></textarea>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveSc(true)">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
























        <div flex layout="column" data-ng-controller="RefactorScController">
            <md-tabs flex layout="column" layout-fill md-border-bottom>


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

                            </div>
                        </div>

                    </md-content>
                </md-tab>
                <md-tab label="Услуги и цены" flex layout="column">
                    <md-content layout-fill flex layout="column">
                        <div flex layout="row">
                            <div flex layout="column" layout-padding>
                                <h1 class="md-display-1">Виды и стоимость работ</h1>



                                <md-divider></md-divider>
                                <form name="addPriceForm" novalidate>
                                    <table>
                                        <tr  style="vertical-align: top;">
                                            <td>
                                                <input type="text" placeholder="Добавить услугу" ng-model="newPriceTitle" required>
                                            </td>
                                            <td><input type="number" placeholder="Цена" step="0.01" ng-model="newPriceCostMin"></td>
                                            <td> - </td>
                                            <td><input type="number" placeholder="Цена" step="0.01" ng-model="newPriceCostMax"></td>
                                            <td>
                                                <md-select style="margin: 0;" name="currency" ng-model="newPriceCurrency">
                                                    <md-option ng-selected="@{{$first}}" ng-repeat="time in currency" value="@{{time}}">@{{ time }}</md-option>
                                                </md-select>
                                            </td>
                                            <td width="100"></td>
                                            <td>
                                                <md-button style="margin: 0;" type="button" ng-click="addPrice(addPriceForm.$valid, sc, newPriceTitle, newPriceCostMin, newPriceCostMax, newPriceCurrency)" class="md-primary md-raised">
                                                    Добавить
                                                </md-button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>

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
                            <img ng-if="!file.base64" src="http://fakeimg.pl/300x300/?text=Foto" alt="add personal" >

                            <img style="max-width: 300px;" ng-if="file.base64" ng-src="@{{'data:'+file.filetype+';base64,'+file.base64}}" alt="@{{sc.service_name}}">

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
                            <img ng-if="!newPersonalPhoto.base64" src="http://fakeimg.pl/300x300/" alt="add personal">
                            <img class="md-card-image" style="max-width: 300px;" ng-if="newPersonalPhoto.base64" ng-src="@{{'data:'+newPersonalPhoto.filetype+';base64,'+newPersonalPhoto.base64}}" alt="@{{sc.service_name}}">

                            <span style="position: absolute; bottom: 8px; right: 5px;"><md-icon>add_a_photo</md-icon></span>
                            <input type="file" ng-hide="true" accept="image/*" aria-label="Фото" ng-model="newPersonalPhoto" base-sixty-four-input required>
                        </label>


                        <md-input-container class="md-block">
                            <input type="text" ng-model="newPersonalName" placeholder="ФИО (Иванов Иван Иванович)" required>
                        </md-input-container>
                        <md-input-container class="md-block">
                            <input type="text" ng-model="newPersonalInfo" placeholder="Должность (Старший мастер)">
                        </md-input-container>
                        <md-input-container class="md-block">
                            <input type="text" ng-model="newPersonalSpecialization" placeholder="Специализация (Мастер по ремонту смартфонов)">
                        </md-input-container>
                        <md-input-container class="md-block">
                            <input type="text" ng-model="newPersonalWorkExp" placeholder="Опыт работы (10 лет)">
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
    </div>


@endsection