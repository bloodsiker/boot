(function () {
    angular.module('App')
        .controller('CatalogCtrl', CatalogCtrl);
    CatalogCtrl.$inject = ['$scope', 'NgMap', '$rootScope', 'model', '_', '$timeout'];
    function CatalogCtrl($scope, NgMap, $rootScope, model, _, $timeout) {

        // ================= CATALOG ========================

        $scope.getCatalog = function () {
            model.get('/catalog').then(function (success) {

                _.mapObject(success.data, function (index) {
                    index.radius = true;
                    console.log(index.start_time);
                    // index.start_time = parseInt(index.start_time.replace(":", ""));
                    // index.end_time = parseInt(index.end_time.replace(":", ""));
                    var brands = [];
                    _.mapObject(index.manufacturers, function (el) {
                        brands.push(el.manufacturer);
                    });
                    index.manufacturers = brands.toString();
                });

                $rootScope.filtered_catalog = [];
                $rootScope.catalog = success.data;

                console.log($rootScope.catalog);



            });




            // ================= MAP



            NgMap.getMap("map").then(function (map) {
                $scope.map = map;

                // map.fitBounds();
                // var center = map.getCenter();
                // google.maps.event.trigger(map, "resize");
                //
                // map.setCenter(center);

                var markers = [];

                $rootScope.catalog.map(function (key) {
                    markers.push(new google.maps.LatLng(key.c1, key.c2));
                });

                // var bounds = new google.maps.LatLngBounds(myPlace, Item_1);
                // map.fitBounds(bounds);
                // console.log(markers);
                zoomToIncludeMarkers(markers);
            });

            $scope.showInfo = function (evt, item) {
                $scope.map.showInfoWindow('foo', this);
                $scope.info = item;
            };

        function zoomToIncludeMarkers(markers) {
            var bounds = new google.maps.LatLngBounds();
            for (var key in markers) {
                bounds.extend(markers[key]);
            }
            $scope.map.fitBounds(bounds);
        }





            // $scope.map.trigger($scope.map, 'resize');
        };



        $scope.getCatalog();


        model.get('/services').then(function (success) {
            console.log(success.data);
            success.data.map(function (key) {
                key.active = false;
            });
            $scope.services = success.data;
        });


        var date_now = new Date ();
        $scope.week_day = date_now.getDay();




        // ============= FILTERS ================


        $scope.filterService = [];
        var filterService = [];
        $scope.selectFilterServices = function (service) {
            service.active = !service.active;

            if (service.active) {
                filterService.push(service.title);
            } else {
                filterService = _.without(filterService, service.title);

            }

        };

        $scope.clearFilterServices = function () {
            $scope.filterService = [];
            filterService = [];
            $scope.services.map(function (key) {
                key.active = false;
            });
            $scope.getCatalog();
        };
        $scope.applyFilterServices = function () {
            $scope.filterService = filterService;
            $scope.getCatalog();
        };

        $scope.removeFilterService = function (index, filter) {
            filterService = _.without(filterService, filter);
            $scope.filterService = filterService;
            // $scope.services[]
            // $scope.services.map(function (key) {
            //     key.active = false;
            // });
        };


        $scope.isOpenServices = false;

        var filterTime;
        $scope.clear_time = function () {

        };



        // ================= ORDER BY

        $scope.activeSort = '';
        $scope.order_event = function (val) {
            $scope.activeSort = val;
            $scope.order_by = function (item) {
                return parseFloat(item[val])
            };
        };



    }
})();
