(function () {
    angular.module('App')
        .controller('IndexCtrl', IndexCtrl);
    IndexCtrl.$inject = ['$scope', '$rootScope', 'model', '$uibModal', '$timeout', '$anchorScroll', '_', 'searchService'];
    
    function IndexCtrl($scope, $rootScope, model, $uibModal, $timeout, $anchorScroll, _, searchService) {


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


        $rootScope.supportCall = function (valid, name, phone, comment) {
            if (valid) {
                model.post('/support', {
                    name: name,
                    phone: phone,
                    comment: comment
                }).then(function (success) {
                    $('#success_call_modal').modal('show');
                }, function (err) {
                    $('#success_call_modal').modal('show');
                });
            }
        };








        // ================= SERVICE CENTER CALL ============================

        $rootScope.openScCall = function (sc) {
            var authMeta = document.querySelector('meta[name="auth"]').getAttribute("content");
            var client = {
                auth: authMeta
            };

            console.log(client);
            if (authMeta) {
                client.address = document.querySelector('meta[name="address"]').getAttribute("content");
                client.name = document.querySelector('meta[name="user"]').getAttribute("content");
                client.phone = document.querySelector('meta[name="phone"]').getAttribute("content");
                client.email = document.querySelector('meta[name="email"]').getAttribute("content");
            }
            console.log(client);
            if (client.auth) {
                $('#call_modal').modal('toggle');
                $scope.serviceIndex = 0;
                $scope.sc = angular.copy(sc);
                console.log($scope.sc);

                $scope.serviceSelected = function (data) {
                    _.mapObject($scope.sc.price, function (key, index) {
                        key.title === data ? $scope.serviceIndex = index : '';
                    });
                };
                $scope.payment_types = ['Наличные'];
                $scope.data = {
                    client_payment_type: 'Наличные',
                    client_manufacturer: $scope.sc.manufacturers.length > 0 ? $scope.sc.manufacturers[0].manufacturer : '',
                    client_service: $scope.sc.price.length > 0 ? $scope.sc.price[0].title : '',
                    client_task_description: '',
                    client_address: client.address,
                    client_name: client.name,
                    client_phone: client.phone,
                    client_email: client.email,

                };

                if (searchService.service_model().length == 1) {
                    var ser = searchService.service_model()[0].title;
                    console.log(ser);
                    if ($scope.sc.price.length > 0) {
                        _.mapObject($scope.sc.price, function (key, index) {
                            if (key.title === ser) {
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

            } else {
                $('#auth_error').modal('toggle');
            }





        };

        $rootScope.scCall = function (valid, data) {
            console.log(valid, data);

            if (valid) {
                var send = {
                    service_center: $scope.sc.id,
                    city: $scope.sc.city.city_name,
                    name: data.client_name,
                    email: data.client_email,
                    phone: data.client_phone,
                    manufacturer: data.client_manufacturer,
                    service: data.client_service,
                    payment_type: data.client_payment_type,
                    client_address: data.client_address,
                    exit_master: data.client_exit_master,
                    task_description: data.client_task_description,
                    cost_of_work_min: $scope.sc.price.length > 0 ? $scope.sc.price[$scope.serviceIndex].price_min : '',
                    cost_of_work_max: $scope.sc.price.length > 0 ? $scope.sc.price[$scope.serviceIndex].price_max : ''
                }
                model.post('/forms/sc', send).then(function (success) {
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
