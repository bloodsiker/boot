<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'main_page')->get());
        return view('site.index', compact('data_seo'));
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
