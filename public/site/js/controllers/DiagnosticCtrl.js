(function () {
    angular.module('App')
        .controller('DiagnosticCtrl', DiagnosticCtrl);
    DiagnosticCtrl.$inject = ['$scope', '$timeout', '$http', 'searchService'];
    function DiagnosticCtrl($scope, $timeout, $http, searchService) {

        $scope.activeTab = 0;
        $scope.activeType = 'phone';
        $scope.problem_watching_check = false;
        $scope.problem_description_check = '';
        var token = document.querySelector('meta[name="_token"]').content;

        $scope.firstStepBtn = function (arg) {
            $http({
                method: 'post',
                url: '/diagnostic',
                data: {action: 'type_device', type_device: arg},
                headers: { 'X-CSRF-TOKEN': token },
            }).then(function (success) {
                $scope.problems_know = success.data.problem_know;
                $scope.problems_watching = success.data.problem_watching;
                $scope.activeTab = 1;
            });
        };

        $scope.reload = function () {
            $scope.problem_watching_check = false;
            $scope.problem_know_check = false;
        };
        $scope.getProblemWatching = function (type, problem) {
            $scope.problem_know_check = problem;

            $http({
                method: 'post',
                url: '/diagnostic',
                data: {action: 'problem_know', type_device: type, problem_know: problem},
                headers: { 'X-CSRF-TOKEN': token },
            }).then(function (success) {
                $scope.problems_watching = success.data;
            });
            if ($scope.problem_watching_check && $scope.problem_know_check) {
                $scope.getProblemDescription(type, $scope.problem_know_check, $scope.problem_watching_check)
            }

        };

        $scope.setProblemWatching = function (type, watching) {
            $scope.problem_watching_check = watching;
            $http({
                method: 'post',
                url: '/diagnostic',
                data: {action: 'problem_watching', type_device: type, problem_watching: watching},
                headers: { 'X-CSRF-TOKEN': token },
            }).then(function (success) {
                $scope.problems_know = success.data;
                console.log(success.data);
                console.log($scope.problems_know);
            });
            if ($scope.problem_watching_check && $scope.problem_know_check) {
                $scope.getProblemDescription(type, $scope.problem_know_check, $scope.problem_watching_check)
            }


        };

        $scope.getProblemDescription = function (type, know, watching) {
            $http({
                method: 'post',
                url: '/diagnostic',
                data: {action: 'problem_know_watching', type_device: type, problem_know: know, problem_watching: watching},
                headers: { 'X-CSRF-TOKEN': token },
            }).then(function (success) {
                $scope.problems_description = success.data;
                $scope.problem_description_check = '';
            });
        };


        $scope.setProblemDescription = function (arg) {
            $scope.problem_description_check = arg
        };

        $scope.getProblemRezult = function (type, know, watching, description) {
            $scope.problem_description_check = description;
            $http({
                method: 'post',
                url: '/diagnostic',
                data: {action: 'problem_description', type_device: type, problem_know: know, problem_watching: watching, problem_description: description},
                headers: { 'X-CSRF-TOKEN': token },
            }).then(function (success) {
                $scope.results = success.data;
                $scope.activeTab = 2;
            });
        };


        $scope.prevPage = function (page) {
            $scope.activeTab = page;
            $scope.results = [];
        };

        $scope.searchService = function (service) {
            console.log(service);
            searchService.setService([service]);
            window.location = '/catalog';
        }

        // ===================================


    }
})();
