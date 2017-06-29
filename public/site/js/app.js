(function () {
    angular.module('App', [
        'ngAnimate',
        'ngSanitize',
        'ui.bootstrap',
        'ngMap',
        'slick',
        'angular-rating',
        'angular.filter',
        'underscore'
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
        $scope.services = '';
        $scope.catalog = '';

        $scope.getSearchData = function () {
            if (!$scope.services) {
                model.get('/services').then(function (success) {
                    $scope.services = success.data;
                });
            }
            if (!$scope.services) {
                model.get('/catalog').then(function (success) {
                    $scope.catalog = success.data;
                });
            }
        };
        $scope.selectServiceSearch = function (service) {
            service.services = service.title;
            searchService.setService([service]);
            window.location = '/catalog';
        };

    }
})();

