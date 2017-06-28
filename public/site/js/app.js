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


        $scope.selectServiceSearch = function (service) {
            // console.log(service);
            service.services = service.title;
            searchService.setService([service]);
            window.location = '/catalog';
        };

    }
})();

