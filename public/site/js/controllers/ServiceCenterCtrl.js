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



        // ================= ADD COMMENT =====================

        $scope.add_comment = {
            user_name: '',
            device_name: '',
            service_name: '',
            service_number: '',
            text: '',
            rating: {
                quality_of_work: 0,
                deadlines: 0,
                compliance_cost: 0,
                price_quality: 0,
                service: 0
            }
        };

        $scope.openPhoto = function (photo) {
            console.log(photo);
            $scope.photoUrl = photo;
        };


        $scope.add_comment_btn = function (valid_form, data) {
            $scope.add_comment_valid = true;

            if (valid_form) {
                $scope.add_comment = {};
                $('#add_comment_modal').modal('hide');
                $('#success_comment_modal').modal('show');

                // ================= POST COMMENTS SERVICE CENTER =====================
                model.post(window.location.pathname+'/comments', data).then(function (success) {
                    $scope.comments = success.data;
                });
            }
        };
    }
})();
