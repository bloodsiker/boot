(function () {
    angular.module('App')
        .service('localeStore', localeStore);

    localeStore.$inject = [];

    function localeStore() {

        this.save = (key, data) => localStorage.setItem(key, angular.toJson(data));
        this.get = key => angular.fromJson(localStorage.getItem(key));
        this.remove = key => localStorage.removeItem(key);

    }
})();