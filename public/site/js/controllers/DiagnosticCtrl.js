(function () {
    angular.module('App')
        .controller('DiagnosticCtrl', DiagnosticCtrl);
    DiagnosticCtrl.$inject = ['$scope', '$timeout', '$http', 'searchService', 'model', '_'];
    function DiagnosticCtrl($scope, $timeout, $http, searchService, model, _) {



        $scope.problem_watching_select = '';
        $scope.problem_know_select = '';
        $scope.problem_description_select = '';



        $scope.firstStep = function () {
            model
                .post('/diagnostics', {action: 'type_device', type_device: 'phone'})
                .then(function (success) {
                    console.log(success);

                    /*$scope.problem_watching_select = '';
                    $scope.problem_know_select = '';
                    $scope.problem_description_select = '';*/
                    $scope.results = '';
                    $scope.problem_watching_select = '';
                    $scope.problem_know_select = '';
                    $scope.problem_description_select = '';
                    $scope.problems_know = success.data.problem_know;
                    $scope.problems_watching = success.data.problem_watching;
                    $scope.problems_description = success.data.problem_description;
            });
        };
        $scope.firstStep();


        $scope.getProblemRezult = function (arg) {


            if (arg === 'desc') {
                $scope.problem_know_select = '';
                $scope.problem_watching_select = '';
            }

            model.post('/diagnostics', {
                action: 'problem_description',
                type_device: 'phone',
                problem_know: $scope.problem_know_select || false,
                problem_watching: $scope.problem_watching_select || false,
                problem_description: $scope.problem_description_select || false
            }).then(function (success) {
                switch (arg) {
                    case 'desc' :

                        $scope.problems_know = success.data.step.problem_know;
                        $scope.problems_watching = success.data.step.problem_watching;

                        $scope.problem_know_select = success.data.step.problem_know[0];

                        $scope.problem_watching_select = success.data.step.problem_watching[0];



                        if ($scope.problem_watching_select || $scope.problem_know_select) {
                            $scope.getProblemRezult();
                        }


                        break;
                    case 'watch' :
                        $scope.problems_know = success.data.step.problem_know;
                        $scope.problems_description = success.data.step.problem_description;
                        if (success.data.step.problem_know) {
                            $scope.problem_know_select = success.data.step.problem_know[0];
                            $scope.getProblemRezult();
                        }
                        if (success.data.step.problem_description.length === 1) {
                            $scope.problem_description_select = success.data.step.problem_description[0];
                            $scope.getProblemRezult('desc');
                        }
                        break;
                    case 'know' :
                        $scope.problems_watching = success.data.step.problem_watching;
                        $scope.problems_description = success.data.step.problem_description;

                        if (success.data.step.problem_watching) {
                            $scope.problem_watching_select = success.data.step.problem_watching[0];
                        }
                        if (success.data.step.problem_description.length === 1) {
                            $scope.problem_description_select = success.data.step.problem_description[0];
                            $scope.getProblemRezult('desc');
                        }

                        break;
                }

                if ($scope.problem_description_select) {
                    if ($scope.problem_watching_select || $scope.problem_know_select) {
                        $scope.results = success.data.result;
                    } else $scope.results = '';
                } else $scope.results = '';

            });

        };

        $scope.searchService = function (service) {
            console.log(service);
            service.title = service.services;
            searchService.setService([service]);
            window.location = '/catalog';
        }

    }
})();
