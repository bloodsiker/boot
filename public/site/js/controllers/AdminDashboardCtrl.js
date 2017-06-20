(function () {
    angular.module('App')
        .controller('AdminDashboardController', AdminDashboardController);

    AdminDashboardController.$inject = ['$scope', 'model', '$interval'];

    function AdminDashboardController($scope, model, $interval) {



        model._get('/cabinet/dashboard_stat').then(function (success) {
            console.log(success.data);

            $scope.top_services = success.data.top_services;
        });
        $scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
        $scope.series = ['Series A', 'Series B'];
        $scope.data = [
            [65, 59, 80, 81, 56, 55, 40],
            [28, 48, 40, 19, 86, 27, 90]
        ];

        $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];



    }
})();
