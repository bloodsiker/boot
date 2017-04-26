<div ng-controller="SearchCtrl">
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h3 class="search-title">Найдите ближайший проверенный сервисный центр</h3>
        </div>
    </div>
    <div class="row search">
        <!--=======================================ADDRESS=======================================-->
        <div class="col-md-6 col-xs-12">
            <uib-tabset active="active">
                <uib-tab index="0" heading="Район" ng-click="reset_address()">
                    <input type="text"
                           typeahead-show-hint="true"
                           placeholder="Искать по всем районам"
                           ng-model="address_model.address"
                           typeahead-min-length="0"
                           uib-typeahead="item as item.address for item in districts |filter:$viewValue | limitTo:8"
                           class="form-control">
                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                </uib-tab>
                <uib-tab index="1" heading="Метро" ng-click="reset_address()">
                    <input type="text"
                           typeahead-show-hint="true"
                           typeahead-min-length="0"
                           placeholder="Искать по всем метро"
                           ng-model="address_model.address"
                           uib-typeahead="item as item.address for item in metro | filter:$viewValue | limitTo:8"
                           class="form-control">
                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                </uib-tab>
                <uib-tab index="2" heading="Улица" ng-click="reset_address()">
                    <input type="text"
                           typeahead-show-hint="true"
                           typeahead-min-length="0"
                           placeholder="Искать по всем улицам"
                           ng-model="address_model.address"
                           uib-typeahead="item as item.address for item in streets | filter:$viewValue | limitTo:8"
                           class="form-control">
                    <span ng-if="address_model.address" ng-click="reset_address()" class="glyphicon glyphicon-remove reset-input"></span>
                </uib-tab>
            </uib-tabset>
        </div>
        <!--=======================================BRAND=======================================-->
        <div class="col-md-4 col-xs-12">
            <div class="name-filed">Бренд</div>
            <div style="position: relative;">
                <input type="text"
                       typeahead-show-hint="true"
                       typeahead-min-length="0"
                       placeholder="Все варианты"
                       ng-model="brand_model"
                       uib-typeahead="item as item.manufacturer for item in brands | filter:$viewValue | limitTo:8"
                       class="form-control">
                <span ng-if="brand_model" ng-click="reset_brand()" class="glyphicon glyphicon-remove
        reset-input"></span>
            </div>


        </div>
        <div class="col-md-2 col-xs-12">
            <button ng-click="search_button(active, address_model.address, brand_model)" class="btn btn-warning">Подобрать</button>
        </div>
    </div>
</div>
