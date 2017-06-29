(function () {
    angular.module('App')
        .controller('RefactorScController', RefactorScController);

    RefactorScController.$inject = ['$scope', '$http', 'model', '_', '$uibModal', '$timeout'];

    function RefactorScController($scope, $http, model, _, $uibModal, $timeout) {
        var url = window.location.pathname.slice(8);


        var alertSuccess = '<div class="alert alert-success alert-dismissible" style="position: fixed;bottom: 0;right: 0;">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                                '<h4><i class="icon fa fa-check"></i> Сохранено!</h4>'+
                                'Данные сервисного центра удачно обновлены'+
                            '</div>';


        model.get('/districts').then(function (success) {
            $scope.districts = success.data;

            model.get('/cities').then(function (success) {
                $scope.cities = [success.data[0]]; // ------------ fix ====================
            });

            model.get('/metro').then(function (success) {
                $scope.metros = success.data;
            });

            model.get('/streets').then(function (success) {
                $scope.streets = success.data;


            });

        });


        function getModel(){
            model.get(url).then(function (success) {

                var work_days = [
                    { title: 'ПН', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'ВТ', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'СР', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'ЧТ', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'ПТ', start_time: '09:00', end_time: '19:00', weekend: false},
                    { title: 'СБ', start_time: '10:00', end_time: '17:00', weekend: '1'},
                    { title: 'ВС', start_time: '10:00', end_time: '17:00', weekend: '1'}
                ];
                if (success.data.advantages) {
                    var advantages = [];
                    success.data.advantages.map(function (key) {
                        advantages.push(key.advantages)
                    });
                    success.data.advantages = advantages;
                }

                if (success.data.tags) {
                    var tags = [];
                    success.data.tags.map(function (key) {
                        tags.push(key.tag)
                    });
                    success.data.tags = tags;
                }

                if (success.data.work_days.length <= 0) {
                    success.data.work_days =  work_days;
                }



                $scope.sc = success.data;


                model.get('/services').then(function (prices) {
                    $scope.currency = ['ГРН'];
                    prices.data.map(function (price) {
                        price.price_min = '';
                        price.price_max = '';
                        price.currency = 'ГРН';
                    });

                    $scope.sc.price.map(function (scPrice) {
                        prices.data.map(function (key) {
                            if (key.title === scPrice.title) {
                                key.active = true;
                                key.price_min = scPrice.price_min;
                                key.price_max = scPrice.price_max;
                                key.currency = scPrice.currency
                            }
                        });
                    });

                    $scope.sc.price.map(function (scPrice) {
                        scPrice.active = true;
                        if (scPrice.is_new == 1) {
                            prices.data.push(scPrice);
                        }
                    });

                    $scope.price_list = prices.data;

                    if ($scope.sc.about) {
                        angular.element('#aboutSc .wysihtml5-sandbox').contents().find("body").html($scope.sc.about);
                    }

                });



                brands(success.data);


            });
        }


        getModel();



        $scope.scLogo = [];
        $scope.$watch('scLogo', function(val, oldVal) {
            console.log(val.base64);
            if (val.base64) {
                model.post('/cabinet' + url + '/add-logo', {logo: val}).then(function (res) {
                    $scope.scLogo = [];
                });
            }

        });



        $scope.saveGlobalSc = function (valid, sc) {
            if (valid) {
                var data = {
                    info: {
                        c1: sc.c1,
                        c2: sc.c2,
                        service_name: sc.service_name,
                        city_id: sc.city.id,
                        city_name: sc.city.city_name,
                        district_id: sc.district.id,
                        street: sc.street,
                        metro_id: sc.metro.id,
                        number_h: sc.number_h,
                        number_h_add: sc.number_h_add,
                        exit_master: sc.exit_master
                    }

                };

                model.put('/cabinet' + url + '/update', data).then(function (res) {
                    console.log(res);

                    angular.element('#alert').append(alertSuccess);
                    $timeout(function () {
                        angular.element('#alert').html('');
                    }, 4000)
                });

            }
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



        // =================================================================
        $scope.week_days = ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'];
        $scope.times_start = [
            '06:00', '06:30',
            '07:00', '07:30',
            '08:00', '08:30',
            '09:00', '09:30',
            '10:00', '10:30',
            '11:00', '11:30',
            '12:00', '12:30',
            '13:00', '13:30',
            '14:00', '14:30'
        ];

        $scope.times_end = [
            '14:00', '14:30',
            '15:00', '15:30',
            '16:00', '16:30',
            '17:00', '17:30',
            '18:00', '18:30',
            '19:00', '19:30',
            '20:00', '20:30',
            '21:00', '21:30',
            '22:00', '22:30'
        ];

        $scope.saveGraphic = function (graphic) {
            var data = {
                work_days: graphic,
            };
            model.put('/cabinet' + url + '/update', data).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                    $timeout(function () {
                        angular.element('#alert').html('');
                    }, 4000)
            });
        };




        // ======================== ЦЕНЫ ==========================
        $scope.newPriceTitle = '';
        $scope.newPriceCostMin = '';
        $scope.newPriceCostMax = '';
        $scope.newPriceCurrency = 'ГРН';
        $scope.showAddPrice = false;

        $scope.addPrice = function (valid, sc, title, price_min, price_max, currency) {
            var oldTitle = _.some($scope.price_list, function (key) {
                return key.title === title;
            });
            if (valid && !oldTitle) {
                $scope.price_list.push({
                    active: true,
                    title: title,
                    price_min: price_min ? price_min : 0,
                    price_max: price_max ? price_max : 0,
                    is_new: 1,
                    currency: currency
                });
                $scope.newPriceTitle = '';
                $scope.newPriceCostMin = '';
                $scope.newPriceCostMax = '';

            }
        };
        $scope.deletePrice = function (sc, index) {
            sc.price.splice(index, 1);
        };

        $scope.showErrorPrice = function (price) {
            $scope.priceError = price.active && parseFloat(price.price_min) > parseFloat(price.price_max);
            return price.active && parseFloat(price.price_min) > parseFloat(price.price_max);
        };

        $scope.saveScPrice = function (valid, price_list) {
            if (valid && !$scope.priceError) {
                $scope.sc.price = [];
                price_list.map(function (key) {
                    if (key.active) {
                        key.price_min = key.price_min ? key.price_min : 0,
                            key.price_max = key.price_max ? key.price_max : 0,
                            $scope.sc.price.push(key);
                    }
                });

                model.put('/cabinet' + url + '/update', {price:$scope.sc.price}).then(function (res) {
                    console.log(res); angular.element('#alert').append(alertSuccess);
                    $timeout(function () {
                        angular.element('#alert').html('');
                    }, 4000)
                });
            }
        };



        $scope.prePhone = '';
        $scope.addPhone = function (phone) {
            $scope.sc.service_phones.push({phone:phone});
            $scope.prePhone = '';
        };
        $scope.removePhone = function (index) {
            $scope.sc.service_phones.splice(index, 1);
        };
        $scope.savePhones = function (phones) {
            var data = [];

            phones.forEach(function (key) {
                data.push(key.phone)
            });
            model.put('/cabinet' + url + '/update', {phones:data}).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                $timeout(function () {
                    angular.element('#alert').html('');
                }, 4000)
            });
        };




        $scope.preEmail = '';
        $scope.addEmail = function (email) {
            $scope.sc.service_emails.push({email:email});
            $scope.preEmail = '';
        };
        $scope.removeEmail = function (index) {
            $scope.sc.service_emails.splice(index, 1);
        };
        $scope.saveEmails = function (emails) {
            var data = [];

            emails.forEach(function (key) {
                data.push(key.email)
            });
            model.put('/cabinet' + url + '/update', {emails:data}).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                $timeout(function () {
                    angular.element('#alert').html('');
                }, 4000)
            });
        };




        $scope.preAdvantage = '';
        $scope.addAdvantages = function (advantag) {
            $scope.sc.advantages.push(advantag);
            $scope.preAdvantage = '';
        };
        $scope.removeAdvantages = function (index) {
            $scope.sc.advantages.splice(index, 1);
        };
        $scope.saveAdvantages = function (advantages) {
            model.put('/cabinet' + url + '/update', {advantages:advantages}).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                    $timeout(function () {
                        angular.element('#alert').html('');
                    }, 4000)
            });
        };




        $scope.preTag = '';
        $scope.addTags = function (tag) {
            $scope.sc.tags.push(tag);
            $scope.preTag = '';
        };
        $scope.removeTags = function (index) {
            $scope.sc.tags.splice(index, 1);
        };
        $scope.saveTags = function (tags) {
            model.put('/cabinet' + url + '/update', {tags:tags}).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                    $timeout(function () {
                        angular.element('#alert').html('');
                    }, 4000)
            });
        };


        $scope.saveBrands = function (brands) {
            model.put('/cabinet' + url + '/update', {manufacturers:brands}).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                $timeout(function () {
                    angular.element('#alert').html('');
                }, 4000)
            });
        }


        function brands(sc) {

            sc.manufacturers.map(function (index) {
                delete index.pivot;
            });
            model.get('/manufacturers').then(function (success) {
                next(sc, success.data);
            });
            function next(sc, brands) {
                $scope.brands = brands;
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
                    $scope.selected.length !== $scope.brands.length);
                };

                $scope.isChecked = function() {
                    return $scope.selected.length === $scope.brands.length;
                };

                $scope.toggleAll = function() {
                    if ($scope.selected.length === $scope.brands.length) {
                        $scope.selected = [];
                        $scope.sc.manufacturers = $scope.selected;
                    } else if ($scope.selected.length === 0 || $scope.selected.length > 0) {
                        $scope.selected = $scope.brands.slice(0);
                        $scope.sc.manufacturers = $scope.selected;
                    }
                };
            }
        }




        $scope.saveAbout = function () {

            var text = angular.element('#aboutSc .wysihtml5-sandbox').contents().find("body").html();

            model.put('/cabinet' + url + '/update', {about:text}).then(function (res) {
                console.log(res); angular.element('#alert').append(alertSuccess);
                $timeout(function () {
                    angular.element('#alert').html('');
                }, 4000)
            });

        };


        // ======================== ГАЛЕРЕЯ ==========================

        $scope.addPhotoFile = [];
        $scope.addPhotoType = 'service_photo';
        $scope.addPhoto = function (valid, type, photo) {
            if (valid) {
                model.post('/cabinet' + url + '/add-photo', {
                    type: type,
                    photo: {data: photo}
                }).then(function (success) {
                    if ($scope.sc.service_photo) {
                        $scope.sc.service_photo.push(success.data[0])
                    } else {
                        $scope.sc.service_photo = [];
                        $scope.sc.service_photo.push(success.data[0]);
                    }
                    $scope.addPhotoFile = [];
                });
            }
        };

        $scope.deletePhoto = function (photos, photo, index) {
            console.log(photos, photo, index);
            model.delete('/cabinet' + url + '/delete-photo/'+photo.id).then(function () {
                photos.splice(index, 1);
            });
        };

        $scope.showPhoto = function(photo) {
            var service_name = $scope.sc.service_name;
            $uibModal.open({
                animation: true,
                ariaLabelledBy: 'show-photo',
                ariaDescribedBy: 'show-photo',
                templateUrl: 'photoShow.html',
                controller: function($scope) {
                    $scope.photoUrl = photo.path + photo.file_name;
                    $scope.title = service_name;
                }
            });
        };




        // ======================== ПЕРСОНАЛ ==========================
        $scope.showAddPersonal = false;


        $scope.newPersonalName='';
        $scope.newPersonalInfo='';
        $scope.newPersonalWorkExp='';
        $scope.newPersonalSpecialization='';
        $scope.newPersonalPhoto='';
        $scope.addPersonFile = [];


        $scope.addPersonal = function (valid, name, info, work_exp, specialization, photo) {
            if (valid) {
                model.post('/cabinet' + url + '/add-personal', {
                    name: name,
                    info: info,
                    work_exp:work_exp,
                    specialization: specialization,
                    avatar: {
                        data: photo
                    }
                }).then(function (success) {
                    if ($scope.sc.personal) {
                        $scope.sc.personal.push(success.data[0]);
                    } else {
                        $scope.sc.personal = [];
                        $scope.sc.personal.push(success.data[0]);
                    }
                });

            }
        };

        $scope.deletePersonal = function (personal, index, idPerson) {

            model.delete('/cabinet' + url + '/delete-personal/'+idPerson.id).then(function () {
                personal.splice(index, 1);
            });

        };

        $scope.showPerson = function (person) {
            $uibModal.open({
                animation: true,
                ariaLabelledBy: 'show-photo',
                ariaDescribedBy: 'show-photo',
                templateUrl: 'personShow.html',
                controller: function($scope) {
                    $scope.photoUrl = person.path + person.file_name;
                    $scope.name = person.name;
                    $scope.info = person.info;
                    $scope.work_exp = person.work_exp;
                    $scope.specialization = person.specialization;

                }
            });
        }







    }
})();
