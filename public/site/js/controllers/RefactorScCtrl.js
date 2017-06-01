(function () {
    angular.module('App')
        .controller('RefactorScController', RefactorScController);

    RefactorScController.$inject = ['$scope', '$http', 'model', '_', '$mdToast', '$mdDialog'];

    function RefactorScController($scope, $http, model, _, $mdToast, $mdDialog) {
        var url = window.location.pathname.slice(8);

        $scope.scLogo = null;
        $scope.$watch('scLogo', function() {
            $scope.visibleSaveLogo = true;
        });
        $scope.addLogo = function (logo) {
            $scope.visibleSaveLogo = false;
            model.post('/cabinet' + url + '/add-logo', {logo: logo}).then(function (res) {
                $mdToast.show($mdToast.simple().position('right bottom').textContent('Сохранено!'));
            });
        };




        $scope.selectedStreet = function (street) {
            if (_.has(street, 'address')) {
                $scope.sc.street = street.address;
                $scope.sc.c1 = street.c1;
                $scope.sc.c2 = street.c2;
            }

        };
        $scope.dragMap = function () {

            $scope.sc.c1 = $scope.map.markers[0].position.lat();
            $scope.sc.c2 = $scope.map.markers[0].position.lng();

            $http({
                method: 'get',
                url: "https://maps.googleapis.com/maps/api/geocode/json?latlng="+$scope.sc.c1+','+$scope.sc.c2
            }).then(function (success) {
                $scope.sc.number_h = success.data.results[0].address_components[0].long_name;
            });

        };

        $scope.changeNumberH = function () {
            var n = $scope.sc.number_h;
            $http({
                method: 'get',
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=Днер,"+$scope.sc.street+','+n
            }).then(function (success) {
                $scope.sc.c1 = success.data.results[0].geometry.location.lat;
                $scope.sc.c2 = success.data.results[0].geometry.location.lng;
            });
        };



        function getModel(){
            model.get(url).then(function (success) {

                var work_days = [
                    { title: 'ПН', start_time: '', end_time: '', weekend: false},
                    { title: 'ВТ', start_time: '', end_time: '', weekend: false},
                    { title: 'СР', start_time: '', end_time: '', weekend: false},
                    { title: 'ЧТ', start_time: '', end_time: '', weekend: false},
                    { title: 'ПТ', start_time: '', end_time: '', weekend: false},
                    { title: 'СБ', start_time: '', end_time: '', weekend: false},
                    { title: 'НД', start_time: '', end_time: '', weekend: false}
                ];
                if (!_.has(success.data, 'work_days')) {
                    success.data.work_days =  work_days;
                }
                $scope.sc = success.data;
                brands(success.data);
            });
        }
        getModel();
        $scope.saveSc = function (valid, sc) {
            if (valid) {

                //$mdToast.show($mdToast.simple().position('right bottom').textContent('Сохранено!'));
                //var url = 'hug';
                //console.log($scope.sc);
                $scope.sc.street.address ? $scope.sc.street = $scope.sc.street.address : '';
                model.put('/cabinet' + url + '/update', $scope.sc).then(function (res) {
                    console.log(res);
                    $mdToast.show($mdToast.simple().position('right bottom').textContent('Сохранено!'));
                });
            } else {
                console.log('Массивы идентичны');
            }
        };
        $scope.addAdvantages = function (advantages, sc_id) {
            return {
                advantages: advantages,
                service_center_id: sc_id
            };
        };
        $scope.addTags = function (tag, sc_id) {
            return {
                tag: tag,
                service_center_id: sc_id
            };
        };

        $scope.work_days = {
          mn: {
              start_time: '',
              end_time: ''
          }
        };
        $scope.week_days = ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'];
        $scope.times_start = [
            '06:00', '06:30',
            '07:00', '07:30',
            '08:00', '08:30',
            '09:00', '09:30',
            '10:00', '10:30',
            '11:00', '11:30'
        ];

        $scope.times_end = [
            '17:00', '17:30',
            '18:00', '18:30',
            '19:00', '19:30',
            '20:00', '20:30',
            '21:00', '21:30',
            '22:00', '22:30'
        ];

        function brands(sc) {

            sc.manufacturers.map(function (index) {
                delete index.pivot;
            });
            model.get('/manufacturers').then(function (success) {
                next(sc, success.data);
            });
            function next(sc, brands) {
                $scope.items = brands;
                $scope.selected = sc.manufacturers;

                $scope.toggle = function (item, list) {
                    var idx = _.findIndex(list, item);
                    if (idx > -1) {
                        list.splice(idx, 1);
                    }
                    else {
                        console.log(item, list);
                        list.push(item);
                    }
                };

                $scope.exists = function (item, list) {
                    return _.findIndex(list, item) > -1
                };

                $scope.isIndeterminate = function() {
                    return ($scope.selected.length !== 0 &&
                    $scope.selected.length !== $scope.items.length);
                };

                $scope.isChecked = function() {
                    return $scope.selected.length === $scope.items.length;
                };

                $scope.toggleAll = function() {
                    if ($scope.selected.length === $scope.items.length) {
                        $scope.selected = [];
                        $scope.sc.manufacturers = $scope.selected;
                    } else if ($scope.selected.length === 0 || $scope.selected.length > 0) {
                        $scope.selected = $scope.items.slice(0);
                        $scope.sc.manufacturers = $scope.selected;
                    }
                };
            }
        }







        // ======================== ГАЛЕРЕЯ ==========================
        $scope.addPhotoDialog = function(ev, sc) {
            $mdDialog.show({
                targetEvent: ev,
                template:
                '<md-dialog aria-label="Добавить фото">' +
                '  <md-dialog-content layout-padding>'+
                '      <form name="adPhotoForm" novalidate>' +
                '           <md-select ng-model="type" aria-label="Тип фото" required>' +
                '                   <md-option selected value="service_photo">Фото</md-option>' +
                '                   <md-option value="certificate">Сертификат</md-option>' +
                '                   <md-option value="licenses">Лицензия</md-option>        ' +
                '           </md-select>' +
                '           <label>' +
                '               <input type="file" accept="image/*" aria-label="Фото" ng-model="file" base-sixty-four-input' +
                ' required> ' +
                '           </label>    ' +
                '      <div layout="row">' +
                '        <md-button aria-label="Добавить фото" type="submit" ng-click="closeDialog()">Отмена</md-button>  ' +
                '<span flex></span>' +
                '       <md-button aria-label="Добавить фото" type="submit" ng-click="addPhoto(adPhotoForm.$valid, type, file)">Добавить</md-button>' +
                '       </div>' +
                '       </form>'+
                '  </md-dialog-content>' +
                '</md-dialog>',
                clickOutsideToClose:true,
                fullscreen: true,
                locals: {
                    sc: sc
                },
                controller: addPhotoController
            });
            function addPhotoController($scope, $mdDialog, sc, model) {
                $scope.file = [];
                $scope.addPhoto = function (valid, type, photo) {
                    // console.log(type);
                    if (valid) {
                        model.post('/cabinet' + url + '/add-photo', {
                            sc_id: sc.id,
                            type: type,
                            photo: {data: photo}
                        }).then(function (success) {
                            console.log(success);
                            if (sc.service_photo) {
                                sc.service_photo.push(success.data[0])
                            } else {
                                sc.service_photo = [];
                                sc.service_photo.push(success.data[0]);
                            }
                            // getModel();

                            $mdDialog.hide();
                        });
                    }
                };
                $scope.closeDialog = function() {
                    $mdDialog.hide();
                };

            }
        };
        $scope.deletePhoto = function (photos, photo, index) {
            // arr.splice(index, 1);
            // $scope.saveSc(true);
            // console.log(photos, photo, index);
            model.delete('/cabinet' + url + '/delete-photo/'+photo.id).then(function (success) {
                photos.splice(index, 1);
                // getModel();
                $mdDialog.hide();
                $mdToast.show($mdToast.simple().position('right bottom').textContent('Удалено!'));
            });

        };
        $scope.showPhoto = function(ev, photo) {
            $mdDialog.show({
                targetEvent: ev,
                template:
                '<md-dialog class="dialog-picture" aria-label="Фото">' +
                '  <md-dialog-content>'+
                '      <div><img ng-src="{{photo}}"></div>  '+
                '  </md-dialog-content>' +
                '</md-dialog>',
                clickOutsideToClose:true,
                fullscreen: true,
                locals: {
                    photo: photo
                },
                controller: showPhotoController
            });
            function showPhotoController($scope, $mdDialog, photo) {
                $scope.photo = photo;
                $scope.closeDialog = function() {
                    $mdDialog.hide();
                };

            }
        };


        // ======================== ЦЕНЫ ==========================
        $scope.newPriceTitle = '';
        $scope.newPriceCost = '';
        $scope.showAddPrice = false;
        $scope.addPrice = function (valid, sc, title, price) {
            if (valid) {
                sc.price.push({
                    service_center_id: sc.id,
                    title: title,
                    price: price
                });
                $scope.newPriceTitle = '';
                $scope.newPriceCost = '';
                $scope.showAddPrice = false;

            }
        };
        $scope.deletePrice = function (sc, index) {
            sc.price.splice(index, 1);
        };


        // ======================== ПЕРСОНАЛ ==========================
        $scope.showAddPersonal = false;

        $scope.deletePersonal = function (sc, index, idPerson) {


            model.delete('/cabinet' + url + '/delete-personal/'+idPerson.id).then(function (success) {
                sc.personal.splice(index, 1);
                // getModel();
                $mdDialog.hide();
                $mdToast.show($mdToast.simple().position('right bottom').textContent('Удалено!'));
            });

            // $scope.saveSc(true, sc);
        };
        $scope.addPersonalDialog = function (ev, sc) {
            $mdDialog.show({
                targetEvent: ev,
                template:
                '<md-dialog aria-label="Добавить фото">' +
                '  <md-dialog-content layout-padding layout="column">'+
                '      <form name="newPersonalForm" novalidate>'+
                '           <input type="file" accept="image/*" aria-label="Фото" ng-model="newPersonalPhoto" base-sixty-four-input required>'+
                '           <md-input-container class="md-block">'+
                '               <input type="text" ng-model="newPersonalName" placeholder="ФИО" required>'+
                '           </md-input-container>'+
                '           <md-input-container class="md-block">'+
                '               <input type="text" ng-model="newPersonalInfo" placeholder="Должность" required>'+
                '           </md-input-container>'+
                '           <div layout="row">' +
                '               <md-button aria-label="Добавить фото" type="submit" ng-click="closeDialog()     ">Отмена</md-button>' +
                '               <span flex></span>           ' +
                '               <md-button type="submit" ng-click="addPersonal(newPersonalForm.$valid, newPersonalName, newPersonalInfo, newPersonalPhoto)">'+
                '               Добавить'+
                '               </md-button>' +
                '            </div>'+
                '               </form>'+
                '  </md-dialog-content>' +
                '</md-dialog>',
                clickOutsideToClose:true,
                fullscreen: true,
                locals: {
                    sc: sc
                },
                controller: addPersonalController
            });
            function addPersonalController($scope, $rootScope, $mdDialog, sc, model) {
                $scope.newPersonalPhoto = [];
                $scope.addPersonal = function (valid, name, info, photo) {
                    console.log($rootScope);
                    if (valid) {
                        model.post('/cabinet' + url + '/add-personal', {
                            service_center_id: sc.id,
                            name: name,
                            info: info,
                            avatar: {
                                data: photo
                            }
                        }).then(function (success) {
                            if (sc.personal) {
                                sc.personal.push(success.data[0])
                            } else {
                                sc.personal = [];
                                sc.personal.push(success.data[0]);
                            }
                            // getModel();

                            $mdDialog.hide();
                        });

                    }
                };
                $scope.closeDialog = function() {
                    $mdDialog.hide();
                }

            }
        };


    }
})();
