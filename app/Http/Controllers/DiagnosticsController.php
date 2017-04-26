<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticsController extends Controller
{
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'diagnostics')->get());
        return view('site.diagnostics', compact('data_seo'));
    }
}
