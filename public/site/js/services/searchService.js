(function () {
    angular.module('App')
        .service('searchService', searchService);

    searchService.$inject = ['$rootScope', '_'];

    function searchService($rootScope, _) {

        this.active =  function () {
            if (localStorage.getItem('active') !== null) {
                return parseInt(localStorage.getItem('active'));
            } else {
                return parseInt(0);
            }
        };

        this.address_model = function () {
            if (localStorage.getItem('address') !== null) {
                return _.isObject(angular.fromJson(localStorage.getItem('address'))) ? angular.fromJson(localStorage.getItem('address')) : {address: ''};
            } else {
                return {address: ''}
            }
        };

        this.brand_model = function () {
            if (localStorage.getItem('brand')  !== null ) {
                return _.isObject(angular.fromJson(localStorage.getItem('brand'))) ? angular.fromJson(localStorage.getItem('brand')) : '';
            } else {
                return '';
            }
        };


        this.service_model = function () {
            if (localStorage.getItem('service')  !== null ) {
                return _.isObject(angular.fromJson(localStorage.getItem('service'))) ? angular.fromJson(localStorage.getItem('service')) : '';
            } else {
                return '';
            }
        };

        this.setSearch = function (data) {
            $rootScope.updateSearch = data;
            _.isObject(data.address_model) ? localStorage.setItem('address', angular.toJson(data.address_model)) : localStorage.removeItem('address');
            _.isObject(data.brand_model) ? localStorage.setItem('brand', angular.toJson(data.brand_model)) : localStorage.removeItem('brand');
            localStorage.setItem('active', angular.toJson(data.active));
        };

        this.setService = function (data) {
            $rootScope.updateSearch = data;
            data ?
                localStorage.setItem('service', angular.toJson(data)) : localStorage.removeItem('service');

        };
    }
})();