<?php

namespace App\Services;

use App\Models\AdminLog;
use Auth;

/**
 * Class AdminLogService
 * @package App\Services
 */
class AdminLogService
{

    /**
     * @param $action
     */
    public function log($action)
    {
        AdminLog::create([
            'user_id' => Auth::user()->id,
            'action' => $action,
            'ip_address' => $this->userIpAddress(),
            'user_agent' => $this->userAgent(),
        ]);
    }


    /**
     * @return mixed
     */
    public function userIpAddress()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @return mixed
     */
    public function userAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}