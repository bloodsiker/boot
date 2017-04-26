(function () {
    angular.module('App')
        .controller('RefactorScController', RefactorScController)

    RefactorScController.$inject = ['$scope', 'model', '_', '$mdToast', '$mdDialog'];

    function RefactorScController($scope, model, _, $mdToast, $mdDialog) {
        var url = window.location.pathname.slice(8);
        $scope.scLogo = [];
        model.get(url).then(function (success) {
            $scope.sc = success.data;
            brands(success.data);
        });
        $scope.saveSc = function (valid) {
            if (valid) {

                $mdToast.show($mdToast.simple().position('right bottom').textContent('Сохранено!'));

                // model.post(url, sc).then(function () {
                //     $mdToast.show($mdToast.simple().position('right bottom').textContent('Сохранено!'));
                // });
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
                    } else if ($scope.selected.length === 0 || $scope.selected.length > 0) {
                        $scope.selected = $scope.items.slice(0);
                    }
                };
            }
        }







        // ======================== ГАЛЕРЕЯ ==========================
        $scope.addPhotoDialog = function(ev, sc_id) {
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
                    sc_id: sc_id
                },
                controller: addPhotoController
            });
            function addPhotoController($scope, $mdDialog, sc_id, model) {
                $scope.file = [];
                $scope.addPhoto = function (valid, type, photo) {
                    console.log(type);
                    if (valid) {
                        model.post('/url', {
                            sc_id: sc_id,
                            type:type,
                            photo: {data: photo}
                        }).then(function (success) {
                            $scope.sc[type] = success.data; // принимаю новый массив фото, зависит от типа фото
                            $mdDialog.hide();
                        });
                    }
                };
                $scope.closeDialog = function() {
                    $mdDialog.hide();
                }

            }
        };
        $scope.deletePhoto = function (sc, arr, index) {
            arr.splice(index, 1);
            $scope.saveSc(true);

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
                }

            }
        }


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

        $scope.deletePersonal = function (sc, index) {
            sc.personal.splice(index, 1);
            $scope.saveSc(true, sc);
        };
        $scope.addPersonalDialog = function (ev, sc_id) {
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
                    sc_id: sc_id
                },
                controller: addPersonalController
            });
            function addPersonalController($scope, $mdDialog, sc_id, model) {
                $scope.newPersonalPhoto = [];
                $scope.addPersonal = function (valid, name, info, photo) {
                    if (valid) {
                        model.post('...', {
                            service_center_id: sc_id,
                            name: name,
                            info: info,
                            avatar: {
                                data: photo
                            }
                        }).then(function (success) {
                            $scope.sc.personal = success.data; // принимаю новый массив персонала
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
