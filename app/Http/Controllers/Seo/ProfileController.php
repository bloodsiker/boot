<?php

namespace App\Http\Controllers\Seo;

use App\Models\User;
use Auth;
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
        dd($request);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
    }
}
