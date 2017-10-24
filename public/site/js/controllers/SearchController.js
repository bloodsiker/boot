(function () {
    angular.module('App')
        .controller('SearchCtrl', SearchCtrl);
    SearchCtrl.$inject = ['$scope', 'model', '_', 'searchService'];
    function SearchCtrl($scope, model, _, searchService) {


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

        $scope.active = searchService.active();
        $scope.address_model = searchService.address_model();
        $scope.brand_model = searchService.brand_model();

        // ================== ADDRESS ========================
        $scope.reset_address = function () {
            $scope.address_model.address = '';
            localStorage.removeItem('address');
        };

        // ================== BRAND ========================
        $scope.reset_brand = function () {
            $scope.brand_model = '';
            localStorage.removeItem('brand');
        };

        //=================== SEARCH BUTTON ===============

        $scope.search_button = function (active, address_model, brand_model) {

            searchService.setSearch({
                active: active,
                address_model: address_model,
                brand_model: brand_model
            });

            if (window.location.pathname === '/about') {
                window.location.pathname = '/'
            }
            console.log(searchService.address_model());

        };




    }
})();
