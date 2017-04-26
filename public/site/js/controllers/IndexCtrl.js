(function () {
    angular.module('App')
        .controller('IndexCtrl', IndexCtrl);
    IndexCtrl.$inject = ['$scope', '$rootScope', 'model', '$uibModal'];
    
    function IndexCtrl($scope, $rootScope, model, $uibModal) {


        // ================= HELP CALL ============================


        $rootScope.helpCall = function (valid, name, phone) {
            console.log(name, phone);
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
            console.log(service_center);
            if (valid) {
                model.post('/forms/main', {
                    name: name,
                    phone: phone,
                    service_center: service_center
                }).then(function (success) {
                    $('help_modal').modal('hide');
                    $('#success_call_modal').modal('show');
                }, function (err) {
                    $('help_modal').modal('hide');
                    $('#success_call_modal').modal('show');
                });
            }
        };
    }
})();
