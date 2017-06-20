<?php

namespace App\Http\Controllers;

use App\Services\SessionFromPage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    /**
     * @var SessionFromPage
     */
    private $sessionFromPage;

    /**
     * SiteController constructor.
     * @param SessionFromPage $sessionFromPage
     */
    public function __construct(SessionFromPage $sessionFromPage)
    {
        $this->sessionFromPage = $sessionFromPage;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'main_page')->get());
        return view('site.index', compact('data_seo'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAbout()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'about')->get());
        return view('site.about', compact('data_seo'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSupport()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'support')->get());
        return view('site.support', compact('data_seo'));
    }
}
