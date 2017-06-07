(function () {
    angular.module('App')
        .controller('DiagnosticCtrl', DiagnosticCtrl);
    DiagnosticCtrl.$inject = ['$scope', '$timeout', '$http'];
    function DiagnosticCtrl($scope, $timeout, $http) {

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
                $scope.problems_know = success.data;
                $scope.activeTab = 1;
            });
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
                $scope.problem_watching_check = false;
            });
        };

        $scope.setProblemWatching = function (agr) {
            $scope.problem_watching_check = agr;
        };

        $scope.getProblemDescription = function (type, know, watching) {
            $http({
                method: 'post',
                url: '/diagnostic',
                data: {action: 'problem_watching', type_device: type, problem_know: know, problem_watching: watching},
                headers: { 'X-CSRF-TOKEN': token },
            }).then(function (success) {
                $scope.problems_description = success.data;
                $scope.results = false;
                $scope.activeTab = 2;
                $scope.problem_description_check = '';
            });
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


            });
        };


        $scope.prevPage = function (page) {
            $scope.activeTab = page;
            $scope.results = [];
        };

        // ===================================


    }
})();
