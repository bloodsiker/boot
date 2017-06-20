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


                    var brands = [];
                    _.mapObject(index.manufacturers, function (el) {
                        brands.push(el.manufacturer);
                    });
                    index.manufacturers = brands.toString();
                });



                $rootScope.filtered_catalog = [];
                $rootScope.catalog = success.data;

                renderMap();


            });




            // ================= MAP

            var renderMap = function () {

                NgMap.getMap("map").then(function (map) {
                    $scope.map = map;


                    var markers = [];

                    $rootScope.catalog.map(function (key) {
                        markers.push(new google.maps.LatLng(key.c1, key.c2));
                    });

                    zoomToIncludeMarkers(markers);
                });

                function zoomToIncludeMarkers(markers) {
                    var bounds = new google.maps.LatLngBounds();
                    for (var key in markers) {
                        bounds.extend(markers[key]);
                    }
                    $scope.map.fitBounds(bounds);
                }
            }




            $scope.showInfo = function (evt, item) {
                $scope.map.showInfoWindow('foo', this);
                $scope.info = item;
            };







            // $scope.map.trigger($scope.map, 'resize');
        };
        $scope.limitCatalog = 15;
        $scope.limitCatalogCount = function () {
            $scope.limitCatalog += 10;
        }






        $scope.getCatalog();


        model.get('/services').then(function (success) {

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
            $timeout(function () {
                $scope.getCatalog();
            }, 100)

        };



        $scope.applyFilterServices = function () {
            $scope.filterService = filterService;

            console.log($scope.filterService);
            $timeout(function () {
                $scope.getCatalog();
            }, 100)
        };

        $scope.removeFilterService = function (index, filter) {


            filterService = _.without(filterService, filter);
            $scope.filterService = _.without($scope.filterService, filter);



            $scope.services.map(function (key, index) {
                key.title === filter ? key.active = false : '';
            });


            //
            //
            // filterService = _.indexOf(filterService, filter);
            // $scope.filterService = filterService;
            // $timeout(function () {
            //     $scope.getCatalog();
            // }, 100)
        };


        $scope.isOpenServices = false;





        // =============================== new =======================

        let work_days = [
            { title: 'ПН', start_time: '09:00', end_time: '19:00', weekend: false},
            { title: 'ВТ', start_time: '09:00', end_time: '19:00', weekend: false},
            { title: 'СР', start_time: '09:00', end_time: '19:00', weekend: false},
            { title: 'ЧТ', start_time: '09:00', end_time: '19:00', weekend: false},
            { title: 'ПТ', start_time: '09:00', end_time: '19:00', weekend: false},
            { title: 'СБ', start_time: '10:00', end_time: '17:00', weekend: '1'},
            { title: 'ВС', start_time: '10:00', end_time: '17:00', weekend: '1'}
        ];


        $scope.week_days = ['ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ', 'ВС'];
        $scope.times_start = [
            '06:00', '06:30',
            '07:00', '07:30',
            '08:00', '08:30',
            '09:00', '09:30',
            '10:00', '10:30',
            '11:00', '11:30',
            '12:00', '12:30',
            '13:00', '13:30',
            '14:00', '14:30'
        ];

        $scope.times_end = [
            '14:00', '14:30',
            '15:00', '15:30',
            '16:00', '16:30',
            '17:00', '17:30',
            '18:00', '18:30',
            '19:00', '19:30',
            '20:00', '20:30',
            '21:00', '21:30',
            '22:00', '22:30'
        ];

        let date = new Date();
        let indexDay = date.getDay();
        $scope.timeFilter = {
            day: work_days[indexDay].title,
            start_time: new Date ('01.01.1970 '+work_days[indexDay].start_time),
            end_time: new Date ('01.01.1970 ' + work_days[indexDay].end_time)
        };

        let _timeFilter = {
            day: work_days[indexDay].title,
            start_time: new Date ('01.01.1970 '+work_days[indexDay].start_time),
            end_time: new Date ('01.01.1970 ' + work_days[indexDay].end_time)
        };



        $scope.applyTime = function () {
            console.log($scope.timeFilter);

            // post server  ==========================

        };
        $scope.clear_time = function () {
            $scope.timeFilter.day = _timeFilter.day;
            $scope.timeFilter.start_time = _timeFilter.start_time;
            $scope.timeFilter.end_time = _timeFilter.end_time;


            // post server ===================
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
