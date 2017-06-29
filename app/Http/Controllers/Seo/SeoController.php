<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

/**
 * Class SeoController
 * @package App\Http\Controllers\Seo
 */
class SeoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCabinet()
    {
        return view('seo_cabinet.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('auth.auth');
    }
}
