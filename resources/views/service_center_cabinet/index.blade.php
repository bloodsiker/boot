@extends('service_center_cabinet.layouts.master')

@section('content')


    <div ng-controller="RefactorScController" ng-cloak>
        <section class="content-header">
            <h1 ng-bind="sc.service_name"></h1>
            <ol class="breadcrumb">
                <li><a href="/cabinet/dashboard"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Cервисный центр</li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">


                {{--============================Главная информация==================================--}}
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-home" aria-hidden="true"></i>  Главная информация</h3>
                        </div>

                        <form role="form" name="saveGlobalForm" novalidate>
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="logoSc">
                                                    <div style="cursor: pointer; position: relative;">
                                                        <img ng-if="!scLogo.base64 && !sc.logo" style="max-width: 100%;" src="http://fakeimg.pl/200x140/?text=Foto" alt="add personal" >
                                                        <img ng-if="scLogo.base64 && !sc.logo" style="max-width: 100%;" ng-src="@{{'data:'+scLogo.filetype+';base64,'+scLogo.base64}}" alt="@{{sc.service_name}}">
                                                        <img ng-if="sc.logo && !scLogo.base64" style="max-width: 100%;" ng-src="@{{sc.logo}}" alt="@{{sc.service_name}}">
                                                        <span style="position: absolute; bottom: 8px; right: 5px;" class="fa fa-camera"></span>
                                                        <input type="file" ng-hide="true" id="logoSc" ng-model="scLogo" accept="image/*" base-sixty-four-input>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Название сервисного центра</label>
                                                    <input type="text" ng-model="sc.service_name" class="form-control" placeholder="Название сервисного центра" required>
                                                </div>
                                            </div>
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
                                            <div class="col-sm-5">
                                                <div style="width: 80%; float: left;position: relative;">
                                                    <div class="form-group drop-street">
                                                        <label>Улица</label>
                                                        <input type="text"
                                                               class="form-control"
                                                               typeahead-on-select="selectedStreet($item)"
                                                               typeahead-show-hint="true"
                                                               typeahead-min-length="0"
                                                               placeholder="Искать улицу"
                                                               ng-model="sc.street"
                                                               required
                                                               uib-typeahead="street as street.address for street in streets | filter:$viewValue | limitTo: 30">
                                                    </div>
                                                    <span ng-if="street.address" style="position: absolute; right: 5px;bottom: 0;line-height: 5.8;" ng-click="street.address = ''" class="glyphicon glyphicon-remove"></span>

                                                </div>
                                                <div style="width: 20%; float: left;">
                                                    <div class="form-group">
                                                        <label>Номер</label>
                                                        <input type="text" class="form-control" ng-change="changeNumberH($event)" ng-model="sc.number_h" required>
                                                    </div>
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>
                                                    <input type="checkbox" ng-true-value="'1'" ng-false-value="'0'" ng-model="sc.exit_master" >
                                                    Выезд мастера</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ng-map id="map"
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
                                <button type="button" class="btn btn-primary" ng-click="saveGlobalSc(saveGlobalForm.$valid, sc)">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>


                {{--============================График работы==================================--}}
                <div class="col-md-5">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-calendar" aria-hidden="true"></i>  График работы</h3>
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
                                        <th>вых.</th>
                                    </tr>
                                    <tr ng-repeat="day in sc.work_days track by $index">
                                        <td ng-bind="day.title"></td>
                                        <td>
                                            <select class="form-control" ng-model="day.start_time" ng-options="time for time in times_start"></select>
                                        </td>
                                        <td>
                                            <select class="form-control" ng-model="day.end_time" ng-options="time for time in times_end"></select>
                                        </td>
                                        <td style="text-align: center; width: 20px;">
                                            <input type="checkbox" ng-model="day.weekend" ng-true-value="'1'" ng-false-value="'0'">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveGraphic(sc.work_days)">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================Виды и стоимость работ==================================--}}
                <div class="col-md-7">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-money" aria-hidden="true"></i>  Виды и стоимость работ</h3>

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
                                    <td>
                                        <span ng-bind="price.title"></span>
                                        <em ng-if="showErrorPrice(price)" style="color: #F44336;">Введите корректную цену</em>
                                    </td>
                                    <td width="100">
                                        <input type="text" class="form-control" ng-class="{'error-input': price.price_min == 0 && price.active}" placeholder="цена от" number-to-string ng-model="price.price_min">
                                        <em ng-if="price.price_min == 0 && price.active" style="color: #F44336;">Введите цену</em>

                                    </td>
                                    <td> - </td>
                                    <td width="100">
                                        <input type="text" class="form-control" ng-class="{'error-input': price.price_max == 0 && price.active}" placeholder="цена до" number-to-string ng-model="price.price_max">
                                        <em ng-if="price.price_max == 0 && price.active" style="color: #F44336;">Введите цену</em>
                                    </td>
                                    <td colspan="2">
                                        <select style="margin: 0;"  class="form-control" ng-model="price.currency" ng-options="cur for cur in currency"></select>
                                    </td>
                                </tr>
                            </table>

                                <form name="addPriceForm" class="text-right">
                                    <table>
                                        <tr style="vertical-align: top; margin-top: 10px;">
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" style="width: 100%;" placeholder="Добавить услугу" ng-model="newPriceTitle" required>
                                            </td>
                                            <td><input type="number" class="form-control" placeholder="Цена" step="0.01" ng-model="newPriceCostMin" required></td>
                                            <td> - </td>
                                            <td><input type="number" class="form-control" placeholder="Цена" step="0.01" ng-model="newPriceCostMax" required></td>
                                            <td>
                                                <select style="margin: 0;" class="form-control"  ng-model="newPriceCurrency" ng-options="cur for cur in currency"></select>
                                            </td>
                                        </tr>

                                    </table>
                                    <button type="button" ng-disabled="!addPriceForm.$valid" ng-click="addPrice(addPriceForm.$valid, sc, newPriceTitle, newPriceCostMin, newPriceCostMax, newPriceCurrency)" class="btn btn-info">добавить</button>


                                </form>
                            </table>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveScPrice(true, price_list)">Сохранить</button>
                        </div>
                    </div>
                </div>


                {{--============================ТЕЛЕФОНЫ==================================--}}
                <div class="col-md-6">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-phone" aria-hidden="true"></i>  Телефоны</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr ng-repeat="phone in sc.service_phones track by $index">
                                    <td ng-bind="phone.phone"></td>
                                    <td class="text-right"><i style="cursor: pointer;" ng-click="removePhone($index)" class="fa fa-trash"></i></td>
                                </tr>
                            </table>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" ng-model="prePhone">
                                <span class="input-group-btn">
                                  <button type="button" ng-disabled="!prePhone" ng-click="addPhone(prePhone)"  class="btn btn-info btn-flat">добавить</button>
                                </span>
                            </div>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="savePhones(sc.service_phones)">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================ПОЧТА==================================--}}
                <div class="col-md-6">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-tags" aria-hidden="true"></i>  Почта</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr ng-repeat="email in sc.service_emails track by $index">
                                    <td ng-bind="email.email"></td>
                                    <td class="text-right"><i style="cursor: pointer;" ng-click="removeEmail($index)" class="fa fa-trash"></i></td>
                                </tr>
                            </table>
                            <div class="input-group input-group-sm">
                                <input type="email" class="form-control" ng-model="preEmail" required>
                                <span class="input-group-btn">
                                  <button type="button" ng-disabled="!preEmail" ng-click="addEmail(preEmail)" class="btn btn-info btn-flat">добавить</button>
                                </span>
                            </div>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveEmails(sc.service_emails)">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================Преимущества==================================--}}
                <div class="col-md-6">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-certificate" aria-hidden="true"></i>  Преимущества</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr ng-repeat="advantage in sc.advantages track by $index">
                                    <td ng-bind="advantage"></td>
                                    <td class="text-right"><i style="cursor: pointer;" ng-click="removeAdvantages($index)" class="fa fa-trash"></i></td>
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
                            <button type="button" class="btn btn-primary" ng-click="saveAdvantages(sc.advantages)">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================Теги==================================--}}
                <div class="col-md-6">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-tags" aria-hidden="true"></i>  Теги</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr ng-repeat="tag in sc.tags track by $index">
                                    <td ng-bind="tag"></td>
                                    <td class="text-right"><i style="cursor: pointer;" ng-click="removeTags($index)" class="fa fa-trash"></i></td>
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
                            <button type="button" class="btn btn-primary" ng-click="saveTags(sc.tags)">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================Бренды==================================--}}
                <div class="col-md-12">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-mobile" aria-hidden="true"></i>  Бренды</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div style="margin-bottom: 10px;">
                                <input type="text" class="form-control" placeholder="Поиск.." ng-model="filterBrand">
                            </div>
                            <div>
                                <input type="checkbox" aria-label="Select All"
                                       ng-checked="isChecked()"
                                       md-indeterminate="isIndeterminate()"
                                       ng-click="toggleAll()">
                                <span ng-if="isChecked()">Снять отметки</span>
                                <span ng-if="!isChecked()">Выбрать все</span>
                            </div>
                            <div class="row">
                                <div class="col-xs-3" ng-repeat="item in brands | filter: filterBrand track by $index">
                                    <input type="checkbox" ng-checked="exists(item, selected)" ng-click="toggle(item, selected)"> @{{ item.manufacturer }}
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveBrands(sc.manufacturers)">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================О компании==================================--}}
                <div class="col-md-12">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> О компании</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body" id="aboutSc">
                            <textarea style="width:100%;" class="aboutSc" name="about" ng-model="sc.about"></textarea>
                        </div>
                        <div class="box-footer text-right" >
                            <button type="button" class="btn btn-primary" ng-click="saveAbout()">Сохранить</button>
                        </div>
                    </div>
                </div>

                {{--============================ГАЛЕРЕЯ==================================--}}
                <div class="col-md-12">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-file-image-o" aria-hidden="true"></i> Фотографии, cертификаты и лицензии</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-sm-6 col-md-3" ng-repeat="photo in sc.service_photo">
                                    <div class="thumbnail">
                                        <img ng-src="@{{photo.path + photo.file_name_mini}}" alt="@{{'Фото ' + sc.service_name}}">
                                        <div class="caption">
                                            <p ng-if="photo.type === 'service_photo'">Фото</p>
                                            <p ng-if="photo.type === 'certificate'">Сертификат</p>
                                            <p ng-if="photo.type === 'licenses'">Лицензия</p>
                                            <p>
                                                <button class="btn btn-primary" type="button" ng-click="deletePhoto(sc.service_photo, photo, $index)">Удалить</button>
                                                <button class="btn btn-default" type="button" ng-click="showPhoto(photo)">Посмотреть</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-6 col-md-3" >
                                    <form name="addPhotoForm" novalidate>
                                    <div class="thumbnail">
                                        <img ng-if="!addPhotoFile.base64" src="http://fakeimg.pl/200x140/?text=Foto" alt="add personal" >
                                        <img ng-if="addPhotoFile.base64" ng-src="@{{'data:'+addPhotoFile.filetype+';base64,'+addPhotoFile.base64}}" alt="@{{sc.service_name}}">

                                        <div class="caption">
                                            <select class="form-control" ng-model="addPhotoType" aria-label="Тип фото" required>
                                                <option value="service_photo">Фото</option>
                                                <option value="certificate">Сертификат</option>
                                                <option value="licenses">Лицензия</option>
                                            </select>
                                            <p style="margin-top: 10px;">
                                                <label class="btn btn-default" style="width: 50%;float: left;" role="button" >
                                                    <i class="fa fa-file-image-o" aria-hidden="true"></i> Выбрать
                                                    <input type="file" ng-hide="true" accept="image/*" aria-label="Фото" ng-model="addPhotoFile" base-sixty-four-input required>
                                                </label>
                                                <button type="button" style="width: 50%;" class="btn btn-default" ng-click="addPhoto(addPhotoForm.$valid, addPhotoType, addPhotoFile)"><i class="fa fa-plus" aria-hidden="true"></i> Добавить</button>
                                            </p>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 {{--============================ПЕРСОНАЛ==================================--}}
                <div class="col-md-12">
                    <div class="box box-primary box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Команда сервиса</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">



                            <div class="row">
                                <div class="col-sm-6 col-md-3" ng-repeat="person in sc.personal">
                                    <div class="thumbnail">
                                        <img ng-src="@{{person.path + person.avatar}}" alt="@{{person.name}}">
                                        <div class="caption">
                                            <h3 ng-bind="person.name"></h3>
                                            <p ng-bind="'Должность:  '+ person.info"></p>
                                            <p ng-bind="'Специализация:  '+ person.specialization"></p>
                                            <p ng-bind="'Опыт работы:  '+ person.work_exp"></p>
                                            <p>
                                                <button class="btn btn-danger" type="button" ng-click="deletePersonal(sc.personal, $index, person)">Удалить</button>
                                                <button class="btn btn-primary" type="button" ng-click="showPerson(person)">Посмотреть</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>





                                <div class="col-sm-6 col-md-3" >
                                    <form name="addPersonForm" novalidate>
                                        <div class="thumbnail">
                                            <img ng-if="!addPersonFile.base64" src="http://fakeimg.pl/200x140/?text=Foto" alt="add personal" >
                                            <img ng-if="addPersonFile.base64" ng-src="@{{'data:'+addPersonFile.filetype+';base64,'+addPersonFile.base64}}" alt="@{{sc.service_name}}">

                                            <div class="caption">

                                                <div class="form-group">
                                                    <label>ФИО</label>
                                                    <input type="text" class="form-control" ng-model="newPersonalName" placeholder="Иванов Иван Иванович" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Должность</label>
                                                    <input type="text" class="form-control" ng-model="newPersonalInfo" placeholder="Старший мастер">
                                                </div>

                                                <div class="form-group">
                                                    <label>Специализация</label>
                                                    <input type="text" class="form-control" ng-model="newPersonalSpecialization" placeholder="Мастер по ремонту смартфонов">
                                                </div>
                                                <div class="form-group">
                                                    <label>Опыт работы</label>
                                                    <input type="text" class="form-control" ng-model="newPersonalWorkExp" placeholder="10 лет">
                                                </div>

                                                <p style="margin-top: 10px;">
                                                    <label class="btn btn-default" style="width: 50%;float: left;" role="button" >
                                                        <i class="fa fa-file-image-o" aria-hidden="true"></i> Фото
                                                        <input type="file" ng-hide="true" accept="image/*" aria-label="Фото" ng-model="addPersonFile" base-sixty-four-input required>
                                                    </label>
                                                    <button ng-disabled="!addPersonForm.$valid" type="button" style="width: 50%;" class="btn btn-primary" ng-click="addPersonal(addPersonForm.$valid, newPersonalName, newPersonalInfo, newPersonalWorkExp, newPersonalSpecialization,  addPersonFile)" ><i class="fa fa-plus" aria-hidden="true"></i> Добавить</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>





        <script type="text/ng-template" id="photoShow.html">
            <div class="modal-body">
                <img ng-src="@{{photoUrl}}" alt="@{{title}}">
            </div>
        </script>

        <script type="text/ng-template" id="personShow.html">
            <div class="modal-header">
                <h3 ng-bind="name"></h3>
            </div>
            <div class="modal-body">
                <img ng-src="@{{photoUrl}}" alt="@{{title}}">
            </div>
            <div class="modal-footer">
                <p ng-bind="'Должность:  '+ info"></p>
                <p ng-bind="'Специализация:  '+ specialization"></p>
                <p ng-bind="'Опыт работы:  '+ work_exp"></p>
            </div>
        </script>



    </div>

<div id="alert"></div>


@endsection