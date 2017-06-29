<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use App\Services\AdminLogService;
use Auth;
use Illuminate\Http\Request;

/**
 * Class SeoController
 * @package App\Http\Controllers\Seo
 */
class SeoController extends Controller
{

    /**
     * @var AdminLogService
     */
    private $adminLog;

    /**
     * SeoController constructor.
     * @param AdminLogService $adminLog
     */
    public function __construct(AdminLogService $adminLog)
    {
        $this->adminLog = $adminLog;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCabinet()
    {
        return view('seo_cabinet.index');
    }

    public function getPages()
    {
        return view('seo_cabinet.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        $this->adminLog->log('Вышел из кабинета');
        return redirect()->route('auth.auth');
    }
}
