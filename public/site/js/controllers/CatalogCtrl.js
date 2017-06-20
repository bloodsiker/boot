(function () {
    angular.module('App')
        .controller('CatalogCtrl', CatalogCtrl);
    CatalogCtrl.$inject = ['$scope', 'NgMap', '$rootScope', 'model', '_', '$timeout', 'searchService', '$filter'];
    function CatalogCtrl($scope, NgMap, $rootScope, model, _, $timeout, searchService, $filter) {

        // ================= CATALOG ========================



        var getCatalog = function () {
            model.get('/catalog').then(function (success) {

                _.mapObject(success.data, function (index) {
                    index.radius = true;


                    var brands = [];
                    _.mapObject(index.manufacturers, function (el) {
                        brands.push(el.manufacturer);
                    });
                    index.manufacturers = brands
                });

                $scope.catalog = success.data;
                $scope._catalog = success.data;


                filtersCatalog();


            });

        };

        getCatalog();


        $scope.limitCatalog = 15;
        $scope.limitCatalogCount = function () {
            $scope.limitCatalog += 10;
        }





        // ============= FILTERS ================


        model.get('/services').then(function (success) {

            success.data.map(function (key) {
                key.active = false;
            });
            $scope.services = success.data;
        });


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









        // =================== RADIUS ===============

        $scope.radiuses = [
            {
                title: '500 м',
                value: '500',
                active: false,
            },
            {
                title: '1 км',
                value: '1000',
                active: false,
            },{
                title: '2 км',
                value: '2000',
                active: false,
            },{
                title: '3 км',
                value: '3000',
                active: true,
            },{
                title: '5 км',
                value: '5000',
                active: false,
            }
            ,{
                title: '10 км',
                value: '10000',
                active: false,
            },
        ];

        $scope.radiusMap = $scope.radiuses[3].value;


        $scope.selectFilterRadius = function (radius) {
            $scope.radiuses.map(function (key) {
                key.active = false;
            });
            radius.active = true;
        };

        $scope.resetRadius = function () {
            $scope.radiuses.map(function (key) {
                key.active = false;
            });

            $scope.radiuses[3].active = true;
            $scope.radiusMap = $scope.radiuses[3].value;

            $rootScope.updateSearch = $scope.radiusMap;
        };


        $scope.applyRadius = function () {
            let radius_map = 0;
            $scope.radiuses.map(function (key) {
                key.active ? radius_map = key.value : '';
            });
            $scope.radiusMap = radius_map;
            $rootScope.updateSearch = $scope.radiusMap;
        };


        // ================= ORDER BY

        $scope.activeSort = '';
        $scope.order_event = function (val) {
            $scope.activeSort = val;
            $scope.order_by = function (item) {
                return parseFloat(item[val])
            };
        };




        // ================= MAP

        var renderMap = function (address) {

            NgMap.getMap("map").then(function (map) {
                $scope.map = map;


                var markers = [];

                $scope.catalog.map(function (key) {
                    markers.push(new google.maps.LatLng(key.c1, key.c2));
                });

                if (address && address.address) {

                    var radius =  ($scope.radiusMap * 0.00001).toFixed(3);
                    markers.push(new google.maps.LatLng(parseFloat(address.c1) + parseFloat(radius), parseFloat(address.c2) + parseFloat(radius)));
                    markers.push(new google.maps.LatLng(parseFloat(address.c1) - parseFloat(radius), parseFloat(address.c2) - parseFloat(radius)));
                }
                zoomToIncludeMarkers(markers);
            });

            function zoomToIncludeMarkers(markers) {


                var bounds = new google.maps.LatLngBounds();
                for (var key in markers) {
                    bounds.extend(markers[key]);
                }
                $scope.map.fitBounds(bounds);
            }
        };




        $scope.showInfo = function (evt, item) {
            $scope.map.showInfoWindow('foo', this);
            $scope.info = item;
        };


        var filtersCatalog = function () {




            $rootScope.$watch('updateSearch', function () {
                console.log('update');


                let address = searchService.address_model();
                $scope.address = searchService.address_model();
                let brand = searchService.brand_model();


                var radius = ($scope.radiusMap * 0.00001).toFixed(3);

                let streetCatalog = [];
                let radiusCatalog = [];
                let metroCatalog = [];
                let districtCatalog = [];
                let brandCatalog = [];

                let globalFilter = [];

                console.log(address);
                $scope.catalog = $scope._catalog;
                if (address && address.address) {
                    angular.forEach($scope._catalog, function (key) {

                        key.street ? key.street === address.address ? streetCatalog.push(key) : '' : '';
                        key.metro && key.metro.address ? key.metro.address === address.address ? metroCatalog.push(key) : '':'';
                        key.district && key.district.address ? key.district.address === address.address ? districtCatalog.push(key) : '' : '';



                        var pi = Math.pow(Math.abs(key.c1 - address.c1), 2) + Math.pow(Math.abs(key.c2 - address.c2), 2);

                        if (pi <= Math.pow(parseFloat(radius), 2)) {
                            radiusCatalog.push(key);
                        }

                    });
                    $scope.catalog = _.union(streetCatalog, radiusCatalog, metroCatalog, districtCatalog);
                }
                if (brand) {
                    angular.forEach($scope.catalog, function (key) {
                        angular.forEach(key.manufacturers, function (b) {
                            b === brand.manufacturer ? brandCatalog.push(key) : '';
                        })
                    });

                    $scope.catalog = brandCatalog;
                    console.log(brandCatalog);
                }






                renderMap(address);
            });




        }

    }
})();
