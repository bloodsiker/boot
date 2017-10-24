(function () {
    angular.module('App')
        .controller('DiagnosticCtrl', DiagnosticCtrl);
    DiagnosticCtrl.$inject = ['$scope', '$timeout', '$http', 'searchService', 'model'];
    function DiagnosticCtrl($scope, $timeout, $http, searchService, model) {



        $scope.problem_watching_select = '';
        $scope.problem_know_select = '';
        $scope.problem_description_select = '';



        $scope.firstStep = function () {
            model
                .post('/diagnostic', {action: 'type_device', type_device: 'phone'})
                .then(function (success) {
                    console.log(success);
                    $scope.problems_know = success.data.problem_know;
                    $scope.problems_watching = success.data.problem_watching;
                    $scope.problems_description = success.data.problem_description;
            });
        };
        $scope.firstStep();


        $scope.getProblemRezult = function (arg) {

            var problem_know_select = $scope.problem_know_select,
                problem_watching = $scope.problem_watching_select,
                problem_description_select = $scope.problem_description_select;

            if (!problem_know_select && !problem_know_select && !problem_description_select) {
                $scope.firstStep();
            } else {
                model.post('/diagnostic', {
                    action: 'problem_description',
                    type_device: 'phone',
                    problem_know: problem_know_select || false,
                    problem_watching: problem_watching || false,
                    problem_description: problem_description_select || false
                }).then(function (success) {
                    switch (arg) {
                        case 'desc' :
                            $scope.problems_know = success.data.problem_know;
                            $scope.problems_watching = success.data.problem_watching;
                            break;
                        case 'watch' :
                            $scope.problems_know = success.data.problem_know;
                            $scope.problems_description = success.data.problem_description;
                            break;
                        case 'know' :
                            $scope.problems_watching = success.data.problem_watching;
                            $scope.problems_description = success.data.problem_description;
                            break;

                    }
                    $scope.results = success.data.result;
                });
            }

        };

        $scope.searchService = function (service) {
            console.log(service);
            service.title = service.services;
            searchService.setService([service]);
            window.location = '/catalog';
        }

    }
})();
