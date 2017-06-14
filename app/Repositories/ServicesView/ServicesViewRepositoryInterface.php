<?php

namespace App\Repositories\ServicesView;

interface ServicesViewRepositoryInterface
{
    public function view($requestData);

    public function topViewServices();

    public function viewByServiceUser($array_id);
}