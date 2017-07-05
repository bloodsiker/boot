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


                $scope._catalog = success.data;
                $scope.catalog = angular.copy($scope._catalog);
                getServices();
                filtersCatalog();
            });

        };

        getCatalog();


        $scope.limitCatalog = 15;
        $scope.limitCatalogCount = function () {
            $scope.limitCatalog += 10;
        };





        // ============= FILTERS ================

        var filterService = [];
        var renderPriceRange = function () {
            if ($scope.filterService.length === 1) {
                $scope.catalog.forEach(function (key) {
                    key.price.forEach(function (price) {
                        if (price.title === $scope.filterService[0].title) {
                            parseFloat($scope.filterService[0].price_max) <= parseFloat(price.price_max) ? $scope.filterService[0].price_max = parseFloat(price.price_max) : '';
                            parseFloat($scope.filterService[0].price_min) >= parseFloat(price.price_min) ? $scope.filterService[0].price_min = parseFloat(price.price_min) : '';
                            $scope.filterService[0]._price_max = $scope.filterService[0].price_max;
                            $scope.filterService[0]._price_min = $scope.filterService[0].price_min;
                        }
                    })
                });
            }
            $rootScope.updateSearch = 'update filter services';
        };

        var getServices = function () {
            model.get('/services').then(function (success) {

                success.data.map(function (key) {
                    key.active = false;
                    key.price_min = 0;
                    key.price_max = 0;
                });
                $scope.services = success.data;

                if (searchService.service_model().length > 0) {
                    var s = searchService.service_model()[0];

                    if (s.services) {
                        s.title = s.services;
                    }


                    s.price_min = s.min_price ? parseFloat(s.min_price) : 0;
                    s.price_max = s.max_price ? parseFloat(s.max_price) : 0;
                    $scope.filterService = [s];
                } else {
                    $scope.filterService = [];
                }
                filterService = angular.copy($scope.filterService);
                renderPriceRange();
            });
        };


        $scope.selectFilterServices = function (service) {
            service.active = !service.active;
            if (service.active) {
                filterService.push(service);
            } else {
                filterService = _.without(filterService, service);

            }
        };
        $scope.clearFilterServices = function () {
            filterService = [];
            $scope.filterService = angular.copy(filterService);
            $scope.services.map(function (key) {
                key.active = false;
            });
            renderPriceRange();
            searchService.setService('');
        };
        $scope.applyFilterServices = function () {
            $scope.filterService = angular.copy(filterService);
            renderPriceRange();

            searchService.setService(filterService);
            filtersCatalog();

        };
        $scope.removeFilterService = function (index, filter) {
            $scope.filterService.splice(index, 1);
            filterService.splice(index, 1);
            $scope.services.map(function (key, index) {
                key.title === filter.title ? key.active = false : '';
            });
            renderPriceRange();
            searchService.setService('');
            filtersCatalog();
        };

        $scope.isOpenServices = false;



        // =============================== new =======================

        var work_days = [
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
        var date = new Date();
        var indexDay = date.getDay() - 1;
        $scope.indexDay = indexDay;
        $scope._timeFilter = {
            day: work_days[indexDay].title,
            start_time: new Date ('01.01.1970 '+work_days[indexDay].start_time),
            end_time: new Date ('01.01.1970 ' + work_days[indexDay].end_time),
            indexDay: indexDay
        };
        var _timeFilter = angular.copy($scope._timeFilter);
        $scope.applyTime = function () {
            $scope._timeFilter.indexDay = $scope.week_days.indexOf($scope._timeFilter.day);
            $scope.timeFilter = angular.copy($scope._timeFilter);
            filtersCatalog();
            // post server  ==========================
        };
        $scope.clear_time = function () {
            $scope._timeFilter.day = _timeFilter.day;
            $scope._timeFilter.start_time = _timeFilter.start_time;
            $scope._timeFilter.end_time = _timeFilter.end_time;
            $scope.timeFilter = '';
            filtersCatalog();
            // post server ===================
        };
        $scope.removeFilterTime = function () {
            $scope.timeFilter = '';
            filtersCatalog();
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
            var radius_map = 0;
            $scope.radiuses.map(function (key) {
                key.active ? radius_map = key.value : '';
            });
            $scope.radiusMap = radius_map;
            $rootScope.updateSearch = $scope.radiusMap;
        };

        // ================= ORDER BY

        $scope.activeSort = '';
        $scope.order_event = function (arg) {


            if (arg === 'name' && $scope.activeSort !== 'name') {
                $scope.reverseIcon = false;
                $scope.catalog =  _.sortBy($scope.catalog, 'service_name');
            }
            if (arg === 'name' && $scope.activeSort === 'name') {
                $scope.reverseIcon = !$scope.reverseIcon;
                $scope.catalog = $scope.catalog.reverse();
            }


            if (arg === 'rating' && $scope.activeSort !== 'rating') {
                $scope.reverseIcon = false;
                var _rating =  _.sortBy($scope.catalog, 'rating');
                $scope.catalog = _rating.reverse();
            }
            if (arg === 'rating' && $scope.activeSort === 'rating') {
                $scope.reverseIcon = !$scope.reverseIcon;
                $scope.catalog = $scope.catalog.reverse();
            }


            if (arg === 'comments' && $scope.activeSort !== 'comments') {
                $scope.reverseIcon = false;
                var _rating =  _.sortBy($scope.catalog, 'comments');
                $scope._comments = _rating.reverse();
            }
            if (arg === 'comments' && $scope.activeSort === 'comments') {
                $scope.reverseIcon = !$scope.reverseIcon;
                $scope.catalog = $scope.catalog.reverse();
            }


            if (arg === 'popular' && $scope.activeSort !== 'popular') {
                $scope.reverseIcon = false;
                var _popular =  _.sortBy($scope.catalog, 'visits');
                $scope._comments = _popular.reverse();
            }
            if (arg === 'popular' && $scope.activeSort === 'popular') {
                $scope.reverseIcon = !$scope.reverseIcon;
                $scope.catalog = $scope.catalog.reverse();
            }

            $scope.activeSort =  arg;

        };

        // ================= MAP

        var renderMap = function (address) {

            NgMap.getMap("map").then(function (map) {
                $scope.map = map;

                $scope.callbackFunc = function(param) {
                    $scope.map.getCenter()
                };

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

                var address = searchService.address_model();
                $scope.address = searchService.address_model();
                var brand = searchService.brand_model();
                var services = $scope.filterService;
                var time = $scope.timeFilter;


                var radius = ($scope.radiusMap * 0.00001).toFixed(3);

                var streetCatalog = [];
                var radiusCatalog = [];
                var metroCatalog = [];
                var districtCatalog = [];
                var brandCatalog = [];
                var servicesCatalog = [];
                var timeCatalog = [];


                var globalFilter = [];

                $scope.catalog = angular.copy($scope._catalog);
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
                    $scope.catalog = _.union(brandCatalog);
                }

                if (services) {
                    if (services.length > 1) {

                        angular.forEach(services, function (service) {
                            angular.forEach($scope.catalog, function (key) {
                                angular.forEach(key.price, function (price) {
                                    price.title === service.title ? servicesCatalog.push(key) : '';
                                });
                            })
                        });
                        $scope.catalog = _.union(servicesCatalog);
                    }

                    if (services.length === 1 ) {
                        angular.forEach($scope.catalog, function (key) {
                            angular.forEach(key.price, function (price) {
                                if (price.title === services[0].title) {
                                    if (price.price_max <= services[0].price_max &&
                                        price.price_min >= services[0].price_min) {
                                        servicesCatalog.push(key)
                                    }
                                }
                            });
                        });
                        $scope.catalog = _.union(servicesCatalog);
                    }
                }



                if (time) {
                    angular.forEach($scope.catalog, function (key) {
                        var _start = Date.parse(time.start_time);
                        var _end = Date.parse(time.end_time);
                        var startS = new Date ('01.01.1970 '+key.work_days[time.indexDay].start_time);
                        var endS = new Date ('01.01.1970 '+key.work_days[time.indexDay].end_time);

                        _start >= startS && _end <= endS ? timeCatalog.push(key) : '';

                    });

                    $scope.catalog = _.union(timeCatalog);
                }






                renderMap(address);
            });




        }

    }
})();
