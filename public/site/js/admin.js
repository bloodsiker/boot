
(function () {
    angular.module('App', [
        'ngAnimate',
        'ngAria',
        'ngMessages',
        'ngMap',
        'ngMaterial',
        'underscore',
        'naif.base64',
        'chart.js'
    ]).config(function($mdThemingProvider, ChartJsProvider) {

        ChartJsProvider.setOptions({
            chartColors: ['#ffb15a', '#ff9300'],
            responsive: true,
            tooltips: { enabled: false }
        });
        // Настроить цвет по своему, просто раскомментируй и измени глубину и код цвета
        // переменные подходят

        // var orange = $mdThemingProvider.extendPalette('orange', {
        //     '500': '#ff0000',
        //     'contrastDefaultColor': 'orange'
        // });

        // $mdThemingProvider.definePalette('orange', orange);

        $mdThemingProvider.theme('default')
            // .primaryPalette('orange')

            .primaryPalette('orange', {
                'default': '500'
            })
            .accentPalette('orange', {
                'default': '500'
            });

    });
})();


