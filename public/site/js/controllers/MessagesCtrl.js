(function () {
    angular.module('App')
        .controller('MessagesCtrl', MessagesCtrl);
    MessagesCtrl.$inject = ['$scope', 'model', '$uibModal'];
    function MessagesCtrl($scope, model, $uibModal) {

        $scope.limitMessages = 30;
        $scope.addLimitMessages = function () {
            $scope.limitMessages += 30;
        };
        model._get('/cabinet/requests').then(function (success) {
            $scope.messages = success.data;
            console.log($scope.messages);
        });

        $scope.activeFilterObject = {};
        $scope.filterMessages = function (filter,data) {

            $scope.activeFilterObject = {};
            $scope.activeFilter = data;
            if (filter !== 'all') {
                $scope.activeFilterObject[filter] = data;
            }



        };

        $scope.updateMessage = function (message, arg) {
            if (arg === 'favorite') {
                message[arg] === '1' ? message[arg] = '0' :  message[arg] = '1';
            }

            var data = {
                id: message.id
            };
            data[arg] = message[arg];

            model.put('/cabinet/messages', data).then(function (success) {
                console.log(success.data);
            });
        };

        $scope.openMessage = function (id) {

            model._get('/cabinet/open/message?id='+id).then(function (success) {
                $uibModal.open({
                    animation: false,
                    templateUrl: 'readMessage.html',
                    size: 'large',
                    controller: function($scope) {
                        $scope.message = success.data;


                        $scope.dt = new Date();
                        $scope.calendar = {opened: false};


                        $scope.dateOptions = {
                            maxDate: new Date(2020, 5, 22),
                            minDate: new Date(),
                            startingDay: 1,
                            showButtonBar: false
                        };

                        $scope.calendarOpen = function() {
                            $scope.calendar.opened = true;
                        };

                        $scope.format ='dd-MM-yyyy';


                    }
                });
            })

        }



    }
})();
