(function () {
    angular.module('App')
        .controller('SettingsController', SettingsController);

    SettingsController.$inject = ['$scope'];

    function SettingsController($scope) {
        $scope.settings = {};
        $scope.addSettingsSc = function (valid, settings) {
            if (!valid) {

            }
            console.log(valid, settings);
        }
    }
});