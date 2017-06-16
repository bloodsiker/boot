(function () {
    angular.module('App')
        .controller('PageServiceCenterCtrl', PageServiceCenterCtrl);
    PageServiceCenterCtrl.$inject = ['$scope', '$rootScope', 'NgMap', 'model', '_'];
    function PageServiceCenterCtrl($scope, $rootScope, NgMap, model, _) {

        // ================= MAP =====================

        NgMap.getMap("map").then(function (map) {
            $scope.map = map;
        });

        // ================= GET INFO SERVICE CENTER =====================
        model.get(window.location.pathname).then(function (success) {
            $scope.service_center = success.data;
        });

        // ================= GET COMMENTS SERVICE CENTER =====================

        model.get(window.location.pathname+'/comments').then(function (success) {
            success.data.list = _.values(success.data.list);
            $scope.comments = success.data;
        });


        var date_now = new Date ();
        $scope.week_day = date_now.getDay();

        // ================= ADD COMMENT =====================

        $scope.add_comment = {
            user_name: '',
            device_name: '',
            service_name: '',
            service_number: '',
            text: '',
            rating: {
                quality_of_work: 3,
                deadlines: 3,
                compliance_cost: 3,
                price_quality: 3,
                service: 3
            }
        };

        $scope.openPhoto = function (photo) {
            console.log(photo);
            $scope.photoUrl = photo;
        };

        $scope.dateBind = function (date) {
          return new Date(date);
        };
        $scope.add_comment_btn = function (valid_form, data) {
            $scope.add_comment_valid = true;

            if (valid_form) {
                $scope.add_comment = {
                    user_name: '',
                    device_name: '',
                    service_name: '',
                    service_number: '',
                    text: '',
                    rating: {
                        quality_of_work: 3,
                        deadlines: 3,
                        compliance_cost: 3,
                        price_quality: 3,
                        service: 3
                    }
                };
                $('#add_comment_modal').modal('hide');
                $('#success_comment_modal').modal('show');

                // ================= POST COMMENTS SERVICE CENTER =====================
                model.post(window.location.pathname+'/add-comments', data).then(function (success) {
                    model.get(window.location.pathname+'/comments').then(function (success) {
                        success.data.list = _.values(success.data.list);
                        $scope.comments = success.data;
                    });
                });
            }
        };
    }
})();
