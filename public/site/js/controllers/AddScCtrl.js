(function () {
    angular.module('App')
        .controller('AddScController', AddScController);

    AddScController.$inject = ['$scope', 'NgMap', '$http', 'model'];

    function AddScController($scope, NgMap, $http, model) {




        model.get('/districts').then(function (success) {
            $scope.districts = success.data;

            model.get('/cities').then(function (success) {
                $scope.cities = [success.data[0]]; // ------------ fix ====================
            });

            model.get('/metro').then(function (success) {
                $scope.metros = success.data;
            });

            model.get('/streets').then(function (success) {
                $scope.streets = success.data;


                renderPage();
            });

        });


        function renderPage() {

            function renderMap () {
                NgMap.getMap("map_admin").then(function (map) {
                    $scope.map = map;
                    var coordinates = new google.maps.LatLng($scope.sc.c1, $scope.sc.c2);
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(coordinates);
                    $scope.map.fitBounds(bounds);
                });

            };


            $scope.street = {
                address: ''
            };
            $scope.sc = {
                name: '',
                c1: '48.475808',
                c2: '35.018782',
                city: $scope.cities[0],
                street: '',
                metro: '',
                number_h: '',
                district: '',
                work_days: [
                    { title: 'ПН', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'ВТ', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'СР', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'ЧТ', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'ПТ', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'СБ', start_time: '10:00', end_time: '17:00', weekend: true},
                    { title: 'НД', start_time: '10:00', end_time: '17:00', weekend: true}
                ]
            };
            renderMap();




            $scope.selectedStreet = function (street) {

                $scope.sc.street = street.address;
                $scope.sc.c1 = street.c1;
                $scope.sc.c2 = street.c2;
                renderMap(street);
            };

            // $scope.dragMap = function () {
            //
            //     $scope.sc.c1 = $scope.map.markers[0].position.lat();
            //     $scope.sc.c2 = $scope.map.markers[0].position.lng();
            //
            //     $http({
            //         method: 'get',
            //         url: "https://maps.googleapis.com/maps/api/geocode/json?latlng="+$scope.sc.c1+','+$scope.sc.c2
            //     }).then(function (success) {
            //         $scope.sc.number_h = success.data.results[0].address_components[0].long_name;
            //     });
            //
            // };

            $scope.changeNumberH = function () {
                var n = $scope.sc.number_h;
                $http({
                    method: 'get',
                    url: "https://maps.googleapis.com/maps/api/geocode/json?address=Днер,"+$scope.sc.street+','+n
                }).then(function (success) {
                    console.log($scope.sc.c1);

                    $scope.sc.c1 = success.data.results[0].geometry.location.lat;
                    $scope.sc.c2 = success.data.results[0].geometry.location.lng;

                    renderMap();
                });
            };

            $scope.addSc = function (valid, sc) {
                if (valid) {

                    sc.city = sc.city.id;
                    sc.district = sc.district.address;
                    sc.metro = sc.metro.address;

                    model.post('/cabinet/add/service', sc).then(function (req) {
                        window.location = '/cabinet/sc/' + req.data.sc_id;
                    })
                }
            };

        }




    }
})();
