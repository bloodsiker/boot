(function () {
    angular.module('App')
        .controller('AdminDashboardController', AdminDashboardController);

    AdminDashboardController.$inject = ['$scope', 'model', '_'];

    function AdminDashboardController($scope, model, _) {


        $scope.options = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                        // OR //
                        beginAtZero: true   // minimum value will be 0.
                    }
                }],
                xAxes: [{
                    display: false,

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

            var ojectsSc = {};
            _.mapObject($scope.visits, function (key, index) {
                ojectsSc[index] = {
                    name: index,
                    data: [],
                    series: [],
                    labels: []
                };
                _.mapObject(key, function (sc) {
                    ojectsSc[index].data.push(sc.views);
                    ojectsSc[index].series.push(sc.date_view);
                    ojectsSc[index].labels.push(sc.date_view);
                })
            });
            $scope.chartsData = ojectsSc;

        });
    }
})();
