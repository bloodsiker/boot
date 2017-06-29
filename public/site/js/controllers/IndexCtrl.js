(function () {
    angular.module('App')
        .controller('IndexCtrl', IndexCtrl);
    IndexCtrl.$inject = ['$scope', '$rootScope', 'model', '$uibModal', '$timeout', '$anchorScroll'];
    
    function IndexCtrl($scope, $rootScope, model, $uibModal, $timeout, $anchorScroll) {



        $scope.topScroll = function () {
            $anchorScroll();
        };

        angular.element(window).on('scroll', function () {
            $timeout(function () {
                $scope.showButtonTop = window.pageYOffset;
            }, 10);
        });
        // ================= HELP CALL ============================


        $rootScope.helpCall = function (valid, name, phone) {
            console.log(valid, name, phone);
            if (valid) {
                model.post('/forms/main', {
                    name: name,
                    phone: phone
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

        $rootScope.openScCall = function (sc_id) {
            $scope.call_sc = sc_id;

        };

        $rootScope.scCall = function (valid, name, phone, service_center) {
            if (typeof service_center === 'object') {
                service_center = service_center.id
            }
            if (valid) {
                model.post('/forms/sc', {
                    name: name,
                    phone: phone,
                    service_center: service_center
                }).then(function (success) {
                    $('.modal').modal('hide');
                    $('#success_call_modal').modal('show');
                }, function (err) {
                    $('.modal').modal('hide');
                    $('#success_call_modal').modal('show');
                });
            }
        };
    }
})();
