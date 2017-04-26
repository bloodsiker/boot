(function () {
    angular.module('App', [
        'ngAnimate',
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
    TopSearchCtrl.$inject = ['$scope'];
    function TopSearchCtrl($scope) {

    }
})();

