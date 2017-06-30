(function () {
    angular.module('App')
        .controller('AdminController', AdminController);

    AdminController.$inject = ['$scope', 'model', '$http'];

    function AdminController($scope, model, $http) {
        // model.get('/districts').then(function (success) {
        //     $scope.districts = success.data;
        // });
        // model.get('/cities').then(function (success) {
        //     // $scope.cities = success.data;
        //     $scope.cities = success.data;
        // });
        // model.get('/metro').then(function (success) {
        //     $scope.metro = success.data;
        // });
        // model.get('/streets').then(function (success) {
        //     $scope.streets = success.data;
        // });
        // $scope.openSideMenu = function () {
        //     $mdSidenav('side').toggle();
        // };


        $scope.addSettingsSc = function (event, valid, settings) {
            valid && settings.passFirst == settings.passLast ? console.log('ok') :  event.preventDefault();


        };

        $scope.deleteService = function (id) {
            console.log(id);
            var r = confirm("Удалить сервисный центр?");
            if (r == true) {
                model.put('/cabinet/sc/'+id+'/disabled', id).then(function () {
                    window.location.reload();
                }, function (err) {
                    console.log(err);
                })
            }
        };

        var showTrash = false;
        model._get('/cabinet/sc/list-disabled').then(function (success) {
            $scope.disabledSc = success.data;
            showTrash = success.data.length > 0;
            console.log(success.data);
        });

        $scope.enableSc = function (id) {
            var r = confirm("Восстановить сервисный центр?");
            if (r == true) {
                model.put('/cabinet/sc/'+id+'/enabled', id).then(function () {
                    window.location.reload();
                }, function (err) {
                    console.log(err);
                })
            }
        };

    }
})();
