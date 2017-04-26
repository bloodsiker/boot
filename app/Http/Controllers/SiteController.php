<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Street;
use App\Models\Metro;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    public function getIndex()
    {
        //dd(Auth::user());
        $city_id = 1;
        $cities = City::all();
        $street = Street::where('city_id', $city_id)->get();
        $metro = Metro::where('city_id', $city_id)->get();
        $district = District::where('city_id', $city_id)->get();
        $technology = DB::table('technologies')->get();
        $manufacturer = DB::table('manufacturers')->get();

        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'main_page')->get());
//        return view('site.index')->with([
//            'cities' => $cities,
//            'metro' => $metro,
//            'district' => $district,
//            'title' => $title
//        ]);

        return view('site.index', compact('cities', 'street', 'metro', 'district', 'data_seo', 'technology', 'manufacturer'));
    }


    public function getAbout()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'about')->get());
        return view('site.about', compact('data_seo'));
    }

    public function getSupport()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'support')->get());
        return view('site.support', compact('data_seo'));
    }

    public function load()
    {
        $path = storage_path() . "/json/brands.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }

        $file = File::get($path); // string
        //$json = json_decode($file);
        dd($file);
//        foreach ($file as $value){
//            DB::table('manufacturers')->insert(
//                [
//                    'address' => $street->address,
//                    'c1' => $street->c1,
//                    'c2' => $street->c2,
//                    'city_id' => 1
//                ]
//            );
//        }
        return true;
    }
}
