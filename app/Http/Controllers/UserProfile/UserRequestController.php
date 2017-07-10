<?php

namespace App\Http\Controllers\UserProfile;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRequestController extends Controller
{
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_requests')->get());
        return view('user_profile.requests.index', compact('data_seo'));
    }
}
