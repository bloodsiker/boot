<?php

namespace App\Http\Controllers\Seo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getIndex()
    {
        return view('seo_cabinet.profile.index');
    }

    public function putProfile(Request $request)
    {

    }
}
