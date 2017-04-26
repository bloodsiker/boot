(function () {
    angular.module('App')
        .controller('CatalogCtrl', CatalogCtrl);
    CatalogCtrl.$inject = ['$scope', 'NgMap', '$rootScope', 'model', '_'];
    function CatalogCtrl($scope, NgMap, $rootScope, model, _) {

        // ================= CATALOG ========================
        model.get('/catalog').then(function (success) {

            _.mapObject(success.data, function (index) {
                index.radius = true;
                index.start_time = parseInt(index.start_time.replace(":", ""));
                index.end_time = parseInt(index.end_time.replace(":", ""));
                var brands = [];
                _.mapObject(index.manufacturers, function (el) {
                    brands.push(el.manufacturer)
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
        });

        $scope.showInfo = function (evt, item) {
            $scope.map.showInfoWindow('foo', this);
            $scope.info = item;
        };

        function zoomToIncludeMarkers(markers) {
            var bounds = new google.maps.LatLngBounds();
            for (var key in markers) {
                bounds.extend(markers[key].getPosition());
            }
            vm.map.fitBounds(bounds);
        }


        // ============ RELOAD MAP

        $("#map-catalog").on('affixed.bs.affix', function () {
            google.maps.event.trigger($scope.map, 'resize');
        });

        $("#map-catalog").on('affixed-top.bs.affix', function () {
            google.maps.event.trigger($scope.map, 'resize');
        });


        $scope.start_time = new Date();
        $scope.end_time = new Date();
        $scope.select_time = function (start, end) {
            var m1 = start.getMinutes() < 9 ? "0"+ start.getMinutes() : start.getMinutes();
            $scope.timeStartFilter = start.getHours()+''+ m1;

            var m2 = end.getMinutes() < 9 ? "0"+ end.getMinutes() : end.getMinutes();
            $scope.timeEndFilter = end.getHours()+''+ m2;


        };
        $scope.clear_time = function () {
            $scope.start_time = 0;
            $scope.end_time = 0;
            $scope.timeStartFilter = '';
        }

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
