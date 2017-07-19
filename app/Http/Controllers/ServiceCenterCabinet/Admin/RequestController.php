<?php

namespace App\Http\Controllers\ServiceCenterCabinet\Admin;

use App\Models\FormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMessages()
    {
        return view('service_center_cabinet.admin.messages');
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function allRequest()
    {
        $all = FormRequest::select('id', 'email', 'name', 'created_at', 'phone', 'services', 'status_id', 'manufacturer', 'favorite', 'service_center_id')
            ->orderBy('id', 'desc')->get();
        $all->load('status', 'service_center');

        return response($all);
    }
}
