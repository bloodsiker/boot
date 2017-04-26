(function () {
    angular.module('App')
        .controller('AddScController', AddScController)

    AddScController.$inject = ['$scope', 'NgMap', 'model'];

    function AddScController($scope, NgMap, model) {
        NgMap.getMap("map").then(function (map) {
            $scope.map = map;
            console.log(map);
        });
        $scope.selectedStreet = function (street) {
            $scope.sc.street = street.id;
            $scope.sc.c1 = street.c1;
            $scope.sc.c2 = street.c2;
        };
        $scope.sc = {
            name: '',
            c1: '',
            c2: '',
            city: '',
            street: '',
            district: ''
        };
        $scope.dragMap = function () {
            $scope.sc.c1 = $scope.map.markers[0].position.lat();
            $scope.sc.c2 = $scope.map.markers[0].position.lng();
        };

        $scope.addSc = function (valid, sc) {
            if (valid) {
                model.post('/add/service', sc)
            }
        };
    }
})();
