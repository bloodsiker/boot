<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceCenter\ServiceCenterRepositoryInterface;

class CatalogController extends Controller
{
    /**
     * @var ServiceCenterRepositoryInterface
     */
    private $sc;

    /**
     * CatalogController constructor.
     * @param ServiceCenterRepositoryInterface $sc
     */
    public function __construct(ServiceCenterRepositoryInterface $sc)
    {
        $this->sc = $sc;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex()
    {
        $service_center = $this->sc->getAllServiceCenter();
        return response()->json($service_center, 200);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getServiceCenter($id)
    {
        $service_center = $this->sc->find($id);
        return response()->json($service_center, 200);
    }


}
