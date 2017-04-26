<?php

namespace App\Http\Controllers;

use App\Models\ServiceCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'catalog')->get());
        return view('site.catalog.catalog', compact('data_seo'));
    }

    public function getServiceCenter($id)
    {
        $sc = ServiceCenter::find($id);
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'sc_view')->get());
        return view('site.catalog.service_center', compact('data_seo', 'sc'));
    }
}
