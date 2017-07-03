(function () {
    angular.module('App')
        .controller('MessagesCtrl', MessagesCtrl);
    MessagesCtrl.$inject = ['$scope', 'model'];
    function MessagesCtrl($scope, model) {

        model._get('/cabinet/requests').then(function (success) {
            $scope.messages = success.data;
            console.log($scope.messages);
        })


    }
})();
