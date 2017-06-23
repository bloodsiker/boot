<?php

namespace App\Services;

use App\Models\FormRequest;

class UserRequestService
{

    /**
     * Generate random r_id and check unique
     * @return mixed
     */
    public function generateRequestID()
    {
        $r_id = random_int(0, 999999999);

        $check_id = FormRequest::checkID($r_id)->first();

        if($check_id){
            self::generateRequestID();
        }
        return (int)$r_id;
    }

}