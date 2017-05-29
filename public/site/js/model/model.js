(function () {
    angular.module('App')
        .service('model', model);
    model.$inject = ['$http'];
    function model($http) {


       if (document.querySelector('meta[name="_token"]').content) {
           var token = document.querySelector('meta[name="_token"]').content;
       }  else {
           alert('token not found');
       }


        this.get = function (url) {
            return $http({
                method: 'get',
                headers: { 'X-CSRF-TOKEN': token },
                url: "/api"+ url
            })
        };
        this.post = function (url, data) {
            return $http({
                method: 'post',
                headers: { 'X-CSRF-TOKEN': token },
                url: url,
                data: data
            })
        };
        this.put = function (url, data) {
            return $http({
                method: 'put',
                headers: { 'X-CSRF-TOKEN': token },
                url: url,
                data: data
            })
        };
        this.delete = function (url, data) {
            return $http({
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': token },
                url: url,
                data: data
            })
        };
    }
})();
