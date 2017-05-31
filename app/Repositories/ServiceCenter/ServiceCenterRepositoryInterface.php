<?php

namespace App\Repositories\ServiceCenter;

interface ServiceCenterRepositoryInterface
{

    public function getAllServiceCenter();

    public function find($id);

    public function addServiceCenter($requestData);

    public function addLogo($requestData, $id);

    public function updateServiceCenter($requestData, $id);

    public function updateAdvantages($requestData, $id);

    public function updateTags($requestData, $id);

    public function updateManufacturer($requestData, $id);

    public function updatePrice($requestData, $id);

<<<<<<< HEAD
    public function addPersonal($requestData, $id);

    public function deletePersonal($id, $id_person);

    public function addPhoto($requestData, $id);

    public function deletePhoto($id, $id_photo);

=======
>>>>>>> 11cdfef1d77f9aaa1d74f974669e3de14da474a6
}