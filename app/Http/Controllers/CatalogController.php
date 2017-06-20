<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\ServicesView;
use App\Repositories\VisitsServiceCenter\VisitsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        if(Session::has('pick_up_service')){
            ServicesView::create([
                'service_center_id' => $id,
                'services' => Session::get('pick_up_service'),
                'date_view' => Carbon::now()->format('Y-m-d')
            ]);
        }

        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'sc_view')->get());
        return view('site.catalog.service_center', compact('data_seo'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function postAddCommentsServiceCenter(Request $request, $id)
    {
        $comment = new Comments();
        $comment->service_center_id = $id;
        $comment->user_name = $request->user_name;
        $comment->device = $request->device_name;
        $comment->service = $request->service_name;
        $comment->service_number = $request->service_number;
        $comment->text = $request->text;
        $comment->r_quality_of_work = $request->rating['quality_of_work'];
        $comment->r_deadlines = $request->rating['deadlines'];
        $comment->r_compliance_cost = $request->rating['compliance_cost'];
        $comment->r_price_quality = $request->rating['price_quality'];
        $comment->r_service = $request->rating['service'];
        $comment->r_total_rating = round((
                $comment->r_quality_of_work +
                $comment->r_deadlines +
                $comment->r_compliance_cost +
                $comment->r_price_quality +
                $comment->r_service) / 5, 0);
        $comment->status = 1;
        $comment->created_at = Carbon::now();
        if($comment->save()){
            return response(['status' => 200]);
        }

        // Отправляем email
        return response(['status' => 400]);
    }
}
