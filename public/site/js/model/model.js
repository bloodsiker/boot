(function () {
    angular.module('App')
        .service('model', model);
    model.$inject = ['$http'];
    function model($http) {

        this.get = function (url) {
            return $http({
                method: 'get',
                url: "/api"+ url
            })
        };
        this.post = function (url, data) {
            return $http({
                method: 'post',
                url: url,
                data: data
            })
        };
    }
})();
