(function () {
    angular.module('App', [
        'ngAnimate',
        'ngSanitize',
        'ui.bootstrap',
        'ngMap',
        'slick',
        'angular-rating',
        'angular.filter',
        'underscore',
        'angularMultiSlider'
    ]);
})();

// app.config(['$qProvider', function ($qProvider) {
//     $qProvider.errorOnUnhandledRejections(false);
// }]);


//===================== SIGN AND REGISTER CONTROLLER ==============

(function () {
    angular.module('App')
        .controller('SignCtrl', SignCtrl);
    SignCtrl.$inject = ['$scope'];
    function SignCtrl($scope) {
        $scope.sign_data = {
            login: '',
            password: ''
        };

        $scope.sign_in_btn = function (valid) {
            $scope.sign_valid = true;
        }
    }
})();


//===================== TOP SEARCH CONTROLLER ==============

(function () {
    angular.module('App')
        .controller('TopSearchCtrl', TopSearchCtrl);
    TopSearchCtrl.$inject = ['$scope', 'model', 'searchService'];
    function TopSearchCtrl($scope, model, searchService) {

        $scope.filterTopSearch = '';


        $scope.getSearchData = function () {
            if (!$scope.services_search) {
                model.get('/services').then(function (success) {
                    $scope.services_search = success.data;
                });
            }
            if (!$scope.catalog_search) {
                model.get('/catalog').then(function (success) {
                    $scope.catalog_search = success.data;
                });
            }
        };
        $scope.selectServiceSearch = function (service) {
            service.services = service.title;
            console.log(service);
            searchService.setService([service]);
            window.location = '/catalog';
        };

    }
})();

