<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Services;

class ServicesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getServices()
    {
        $services = Services::select(['id', 'name'])->where('enable', 1)->get();
        return response()->json($services, 200);
    }
}
