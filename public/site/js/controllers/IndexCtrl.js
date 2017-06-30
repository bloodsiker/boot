(function () {
    angular.module('App')
        .controller('IndexCtrl', IndexCtrl);
<<<<<<< HEAD
    IndexCtrl.$inject = ['$scope', '$rootScope', 'model', '$uibModal', '$timeout', '$anchorScroll'];
    
    function IndexCtrl($scope, $rootScope, model, $uibModal, $timeout, $anchorScroll) {
=======
    IndexCtrl.$inject = ['$scope', '$rootScope', 'model', '$uibModal', '$timeout', '$anchorScroll', '_', 'searchService'];
    
    function IndexCtrl($scope, $rootScope, model, $uibModal, $timeout, $anchorScroll, _, searchService) {
>>>>>>> e70a4f41c34b75a710b735b70caf22c5345f1cfd



        $scope.topScroll = function () {
            $anchorScroll();
        };

        angular.element(window).on('scroll', function () {
            $timeout(function () {
                $scope.showButtonTop = window.pageYOffset;
            }, 10);
        });
        // ================= HELP CALL ============================


        $rootScope.helpCall = function (valid, name, phone, comment) {
            console.log(valid, name, phone);
            if (valid) {
                model.post('/forms/main', {
                    name: name,
                    phone: phone,
                    comment: comment
                }).then(function (success) {
                    $('#help_modal').modal('hide');
                    $('#success_call_modal').modal('show');
                }, function (err) {
                    $('#help_modal').modal('hide');
                    $('#success_call_modal').modal('show');
                });
            }
        };




        // ================= SERVICE CENTER CALL ============================

        $rootScope.openScCall = function (sc) {

            $scope.serviceIndex = 0;
            $scope.sc = angular.copy(sc);
            console.log($scope.sc);

            $scope.serviceSelected = function (data) {
                _.mapObject($scope.sc.price, function (key, index) {
                    key.title === data ? $scope.serviceIndex = index : '';
                });
            };
            $scope.payment_types = ['Наличные',];
            $scope.data = {
                client_payment_type: 'Наличные',
                client_manufacturer: $scope.sc.manufacturers.length > 0 ? $scope.sc.manufacturers[0].manufacturer : '',
                client_service: $scope.sc.price.length > 0 ? $scope.sc.price[0].title : '',
                client_task_description: '',

            };

            if (searchService.service_model().length == 1) {
                var ser = searchService.service_model()[0].title;
                console.log(ser);
                if ($scope.sc.price.length > 0) {
                    _.mapObject($scope.sc.price, function (key, index) {
                        if (key.title === ser) {
                            $scope.data.client_service = ser;
                            $scope.serviceIndex = index
                        }
                    });
                }

            }
            if (searchService.brand_model()) {
                console.log(searchService.brand_model());

                var brand = searchService.brand_model().manufacturer;

                if ($scope.sc.manufacturers.length > 0) {
                    _.mapObject($scope.sc.manufacturers, function (key) {
                        if (key.manufacturer === brand) {
                            $scope.data.client_manufacturer = brand;
                        }
                    });
                }

            }




        };

        $rootScope.scCall = function (valid, data) {
            console.log(valid, data);

            if (valid) {
<<<<<<< HEAD
                model.post('/forms/sc', {
                    name: name,
                    phone: phone,
                    service_center: service_center
                }).then(function (success) {
=======
                var send = {
                    service_center: $scope.sc.id,
                    city: $scope.sc.city.city_name,
                    name: data.client_name,
                    email: data.client_email,
                    phone: data.client_phone,
                    manufacturer: data.client_manufacturer,
                    service: data.client_service,
                    payment_type: data.client_payment_type,
                    exit_master: data.client_exit_master,
                    task_description: data.client_task_description,
                    cost_of_work_min: $scope.sc.price.length > 0 ? $scope.sc.price[$scope.serviceIndex].price_min : '',
                    cost_of_work_max: $scope.sc.price.length > 0 ? $scope.sc.price[$scope.serviceIndex].price_max : ''
                }
                model.post('/forms/sc', send).then(function (success) {
>>>>>>> e70a4f41c34b75a710b735b70caf22c5345f1cfd
                    $('.modal').modal('hide');
                    $('#success_call_modal').modal('show');
                }, function (err) {
                    $('.modal').modal('hide');
                    $('#success_call_modal').modal('show');
                });
            };
        };
    }
})();
