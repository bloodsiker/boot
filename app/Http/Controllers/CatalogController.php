<?php

namespace App\Http\Controllers;

use App\Repositories\VisitsServiceCenter\VisitsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{

    /**
     * @var VisitsRepositoryInterface
     */
    private $visitsRepository;

    public function __construct(VisitsRepositoryInterface $visitsRepository)
    {

        $this->visitsRepository = $visitsRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'catalog')->get());
        return view('site.catalog.catalog', compact('data_seo'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getServiceCenter($id)
    {
        $this->visitsRepository->addVisits($id);

        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'sc_view')->get());
        return view('site.catalog.service_center', compact('data_seo'));
    }
}
