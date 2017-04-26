(function () {
    angular.module('App')
        .controller('SearchCtrl', SearchCtrl);
    SearchCtrl.$inject = ['$scope', 'model', '$rootScope'];
    function SearchCtrl($scope, model, $rootScope) {


        model.get('/districts').then(function (success) {
            $scope.districts = success.data;
        });
        model.get('/metro').then(function (success) {
            $scope.metro = success.data;
        });
        model.get('/streets').then(function (success) {
            $scope.streets = success.data;
        });
        model.get('/manufacturers').then(function (success) {
            $scope.brands = success.data;
        });


        // ================== ADDRESS ========================

        $scope.reset_address = function () {
            $scope.address_model = {address: ''};
            localStorage.setItem('address', angular.toJson($scope.address_model));
        };

        // ================== BRAND ========================

        $scope.reset_brand = function () {
            $scope.brand_model = '';
            localStorage.setItem('manufacturer', angular.toJson($scope.brand_model));
        };

        //=================== SEARCH BUTTON ===============
        $scope.active = 0;
        $scope.search_button = function (active, address_model, brand_model) {

            localStorage.setItem('address', angular.toJson(address_model));
            localStorage.setItem('active', angular.toJson(active));
            localStorage.setItem('manufacturer', angular.toJson(brand_model));

            $rootScope.manufacturerFilter = brand_model.manufacturer;
            if (window.location.pathname === '/') {
                window.location.pathname = '/catalog'
            } else {
                $rootScope.addressFilter = '';
                var r = 0.030;
                $rootScope.catalog.forEach(function (index) {
                    index.radius = true;
                    if (address_model !== '') {
                        var pi = Math.pow(Math.abs(index.c1 - address_model.c1), 2) + Math.pow(Math.abs(index.c2 - address_model.c2), 2);

                        if (pi <= Math.pow(r, 2)) {
                            $rootScope.addressFilter = '';
                            index.radius = true;
                        } else {
                            $rootScope.addressFilter = address_model.address;
                            index.radius = false;
                            console.log('false radius');
                        }
                    }
                });
                google.maps.event.trigger($scope.map, 'resize');
            }
        };





        if (localStorage.getItem('manufacturer')) {
            $scope.brand_model = angular.fromJson(localStorage.getItem('manufacturer'));
            $rootScope.manufacturerFilter = $scope.brand_model.manufacturer;

        } else $scope.brand_model = '';

        if (localStorage.getItem('address') && localStorage.getItem('active')) {
            $scope.active = angular.fromJson(localStorage.getItem('active'));
            $scope.address_model = {address: ''};
            $scope.address_model.address = angular.fromJson(localStorage.getItem('address'));

        } else $scope.address_model = {address: ''};



    }
})();
