(function () {
    angular.module('App')
        .controller('AddScController', AddScController)

    AddScController.$inject = ['$scope', '$http' , 'NgMap', 'model'];

    function AddScController($scope, $http, NgMap, model) {
        NgMap.getMap("map").then(function (map) {
            $scope.map = map;

        });
        $scope.selectedStreet = function (street) {
            console.log(street);
            $scope.sc.street = street.address;
            $scope.sc.c1 = street.c1;
            $scope.sc.c2 = street.c2;
        };

        $scope.sc = {
            name: '',
            c1: '',
            c2: '',
            city: '',
            street: '',
            number_h: '',
            district: '',
            work_days: [
                { title: 'ПН', start_time: '', end_time: '', weekend: false},
                { title: 'ВТ', start_time: '', end_time: '', weekend: false},
                { title: 'СР', start_time: '', end_time: '', weekend: false},
                { title: 'ЧТ', start_time: '', end_time: '', weekend: false},
                { title: 'ПТ', start_time: '', end_time: '', weekend: false},
                { title: 'СБ', start_time: '', end_time: '', weekend: false},
                { title: 'НД', start_time: '', end_time: '', weekend: false}
            ]
        };
        $scope.dragMap = function () {

            $scope.sc.c1 = $scope.map.markers[0].position.lat();
            $scope.sc.c2 = $scope.map.markers[0].position.lng();

            $http({
                method: 'get',
                url: "https://maps.googleapis.com/maps/api/geocode/json?latlng="+$scope.sc.c1+','+$scope.sc.c2
            }).then(function (success) {
                $scope.sc.number_h = success.data.results[0].address_components[0].long_name;
            });

        };
        
        $scope.changeNumberH = function () {
            var n = $scope.sc.number_h;
            $http({
                method: 'get',
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=Днер,"+$scope.sc.street+','+n
            }).then(function (success) {
                $scope.sc.c1 = success.data.results[0].geometry.location.lat;
                $scope.sc.c2 = success.data.results[0].geometry.location.lng;
            });
        };

        $scope.addSc = function (valid, sc) {
            if (valid) {
                model.post('/cabinet/add/service', sc).then(function (req) {
                    window.location = '/cabinet/sc/' + req.data.sc_id;
                })
            }
        };
    }
})();
