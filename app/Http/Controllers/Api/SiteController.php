<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Street;
use App\Models\Metro;
use App\Models\District;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities()
    {
        $cities = City::all();
        return response()->json($cities, 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStreets()
    {
        $city_id = 1;
        $street = Street::where('city_id', $city_id)->get();
        return response()->json($street, 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMetro()
    {
        $city_id = 1;
        $metro = Metro::where('city_id', $city_id)->get();
        return response()->json($metro, 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts()
    {
        $city_id = 1;
        $district = District::where('city_id', $city_id)->get();
        return response()->json($district, 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getManufacturers()
    {
        $manufacturer = Manufacturer::orderBy('manufacturer', 'asc')->get();
        return response()->json($manufacturer, 200);
    }
}
