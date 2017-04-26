(function () {
    angular.module('App')
        .controller('AdminDashboardController', AdminDashboardController)

    AdminDashboardController.$inject = ['$scope', 'model', '$interval'];

    function AdminDashboardController($scope, model, $interval) {

        $scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
        $scope.series = ['Series A', 'Series B'];
        $scope.data = [
            [65, 59, 80, 81, 56, 55, 40],
            [28, 48, 40, 19, 86, 27, 90]
        ];
        $scope.onClick = function (points, evt) {
            console.log(points, evt);
        };
        $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
        $scope.options = {
            scales: {
                yAxes: [
                    {
                        id: 'y-axis-1',
                        type: 'linear',
                        display: true,
                        position: 'left'
                    },
                    {
                        id: 'y-axis-2',
                        type: 'linear',
                        display: true,
                        position: 'right'
                    }
                ]
            }
        };

        createChart();
        $interval(createChart, 2000);

        function createChart () {
            $scope.series1 = [];
            $scope.data1 = [];
            for (var i = 0; i < 50; i++) {
                $scope.series1.push('Series'+ i);
                $scope.data1.push([{
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: randomRadius()
                }]);
            }
        }

        function randomScalingFactor () {
            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
        }

        function randomRadius () {
            return Math.abs(randomScalingFactor()) / 4;
        }

        $scope.onClick = function (points, evt) {
            console.log(points, evt);
        };
        $scope.datasetOverride1 = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
        $scope.options1 = {
            scales: {
                yAxes: [
                    {
                        id: 'y-axis-1',
                        type: 'linear',
                        display: true,
                        position: 'left'
                    },
                    {
                        id: 'y-axis-2',
                        type: 'linear',
                        display: true,
                        position: 'right'
                    }
                ]
            }
        };

    }
})();
