
(function () {
    angular.module('App', [
        'ui.bootstrap',
        'ngAnimate',
        'ngAria',
        'ngMessages',
        'ngMap',
        'underscore',
        'naif.base64',
        'lr.upload',
        'chart.js'
    ]).config(function(ChartJsProvider) {

        ChartJsProvider.setOptions({

            responsive: true,
            tooltips: { enabled: true }
        });


    });
})();


