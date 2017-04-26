(function () {
    angular.module('App')
        .controller('AdminController', AdminController)

    AdminController.$inject = ['$scope', '$mdSidenav', 'model'];

    function AdminController($scope, $mdSidenav, model) {
        model.get('/districts').then(function (success) {
            $scope.districts = success.data;
        });
        model.get('/cities').then(function (success) {
            // $scope.cities = success.data;
            $scope.cities = success.data;
        });
        model.get('/metro').then(function (success) {
            $scope.metro = success.data;
        });
        model.get('/streets').then(function (success) {
            $scope.streets = success.data;
        });
        $scope.openSideMenu = function () {
            $mdSidenav('side').toggle();
        };

    }
})();
