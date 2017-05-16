<?php

namespace App\Repositories\ServiceCenter;

interface ServiceCenterRepositoryInterface
{

    public function getAllServiceCenter();

    public function find($id);

    public function addServiceCenter($requestData);

    public function updateServiceCenter($requestData, $id);

    public function updateAdvantages($requestData, $id);

    public function updateTags($requestData, $id);

}