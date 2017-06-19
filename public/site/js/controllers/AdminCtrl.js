(function () {
    angular.module('App')
        .controller('AdminController', AdminController)

    AdminController.$inject = ['$scope', '$mdSidenav', 'model', '$mdDialog', '$http'];

    function AdminController($scope, $mdSidenav, model, $mdDialog, $http) {
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
        $http({
            method: 'get',
            url: '/cabinet/sc/list-disabled'
        }).then(function (success) {
            console.log(success.data);
            showTrash = success.data.length > 0;
        });

        $scope.showTrash = function () {
            return showTrash;
        }

        $scope.openTrash = function () {
            $mdDialog.show({
                templateUrl: 'trash.html',
                clickOutsideToClose:true,
                fullscreen: true,
                controller: trashController
            });
        };
        function trashController($scope, $mdDialog, model) {
            $http({
                method: 'get',
                url: '/cabinet/sc/list-disabled'
            }).then(function (success) {
                $scope.disabledSc = success.data;
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
            $scope.closeDialog = function() {
                $mdDialog.hide();
            };

        }

    }
})();
