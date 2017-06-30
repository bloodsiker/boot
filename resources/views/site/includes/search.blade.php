<div ng-controller="SearchCtrl">
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h3 class="search-title">Найдите ближайший проверенный сервисный центр</h3>
        </div>
    </div>
    <div class="search">
        <!--=======================================ADDRESS=======================================-->
        <div style="flex: 40;padding-left: 20px;padding-right: 20px;" class="dropdown-limit">
            <uib-tabset active="active">
                <uib-tab index="0" heading="Район" ng-click="reset_address()">
                    <input type="text"
                           typeahead-show-hint="true"
                           placeholder="Искать по всем районам"
                           ng-model="address_model.address"
                           typeahead-min-length="0"
                           uib-typeahead="item as item.address for item in districts |filter:$viewValue"
                           class="form-control">
                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                </uib-tab>
                <uib-tab index="1" heading="Метро" ng-click="reset_address()">
                    <input type="text"
                           typeahead-show-hint="true"
                           typeahead-min-length="0"
                           placeholder="Искать по всем метро"
                           ng-model="address_model.address"
                           uib-typeahead="item as item.address for item in metro | filter:$viewValue"
                           class="form-control">
                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                </uib-tab>
                <uib-tab index="2" heading="Улица" ng-click="reset_address()">
                    <input type="text"
                           typeahead-show-hint="true"
                           typeahead-min-length="0"
                           placeholder="Искать по всем улицам"
                           ng-model="address_model.address"
                           uib-typeahead="item as item.address for item in streets | filter:$viewValue | limitTo:30"
                           class="form-control">
                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                </uib-tab>
            </uib-tabset>
        </div>
        <!--=======================================BRAND=======================================-->
        <div style="flex: 20;padding-right: 20px; padding-left: 20px; text-align: left;">
            <div class="name-filed">Бренд</div>
            <div style="position: relative;" class="dropdown-limit">
                <input type="text"
                       typeahead-show-hint="true"
                       typeahead-min-length="0"
                       placeholder="Все варианты"
                       ng-model="brand_model"
                       uib-typeahead="item as item.manufacturer for item in brands | filter:$viewValue"
                       class="form-control">
                <span ng-if="brand_model" ng-click="reset_brand()" class="glyphicon glyphicon-remove
        reset-input"></span>
            </div>


        </div>
        <div style="padding-right: 20px; padding-left: 20px;">
            <button ng-click="search_button(active, address_model.address, brand_model)" class="btn btn-yellow">Подобрать</button>
        </div>
    </div>
</div>
