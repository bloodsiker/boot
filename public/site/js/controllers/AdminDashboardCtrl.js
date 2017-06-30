(function () {
    angular.module('App')
        .controller('AdminDashboardController', AdminDashboardController);

    AdminDashboardController.$inject = ['$scope', 'model', '_'];

    function AdminDashboardController($scope, model, _) {


        $scope.options = {
            scales: {
                yAxes: [{

                }],
                xAxes: [{
                    display: false
                }]
            }
        };
        model._get('/cabinet/dashboard_stat').then(function (success) {
            console.log(success.data);

            $scope.top_services = success.data.top_services;
            $scope.serviceDataChart = [];
            $scope.serviceSeriesChart = [];
            $scope.top_services.forEach(function (key) {
                $scope.serviceDataChart.push(key.view);
                $scope.serviceSeriesChart.push(key.services);
            });


            $scope.visits = success.data.visits;

            $scope.visitData = function (visit) {
                var data = [];
                visit.forEach(function (key) {
                    data.push(key.views);
                });
                return data;
            };

            $scope.visitlabels = function (visit) {
                var data = [];
                visit.forEach(function (key) {
                    data.push(key.date_view);
                });
                return data;
            };


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
