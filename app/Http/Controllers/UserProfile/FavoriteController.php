<?php

namespace App\Http\Controllers\UserProfile;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_favorite')->get());
        $favorite_centers = \Auth::user()->load('favorite_service');
        return view('user_profile.favorite', compact('data_seo', 'favorite_centers'));
    }
}
