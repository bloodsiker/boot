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
    public function getCities()
    {
        $cities = City::all();
        return response()->json($cities, 200);
    }

    public function getStreets()
    {
        $city_id = 1;
        $street = Street::where('city_id', $city_id)->get();
        //dd($response);
        return response()->json($street, 200);
    }

    public function getMetro()
    {
        $city_id = 1;
        $metro = Metro::where('city_id', $city_id)->get();
        //dd($response);
        return response()->json($metro, 200);
    }

    public function getDistricts()
    {
        $city_id = 1;
        $district = District::where('city_id', $city_id)->get();
        //dd($response);
        return response()->json($district, 200);
    }

    public function getManufacturers()
    {
        $manufacturer = Manufacturer::all();
        //dd($response);
        return response()->json($manufacturer, 200);
    }
}
