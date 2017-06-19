<?php

namespace App\Repositories\ServicesView;

use App\Models\ServicesView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class ServicesViewRepository
 * @package App\Repositories\ServicesView
 */
class ServicesViewRepository implements ServicesViewRepositoryInterface
{

    /**
     * Viewing the service from the diagnosis
     * @param $requestData
     * @return bool
     */
    public function view($requestData)
    {
       $view = new ServicesView();
       $view->service_center_id = !empty($requestData->service_center_id) ? $requestData->service_center_id : null;
       $view->services = $requestData->services;
       $view->date_view = Carbon::now()->format('Y-m-d');
       $view->save();
       return true;
    }


    /**
     * Популярные услуги которыми интереовались через диагностику
     * @return array
     */
    public function topViewServices()
    {
        ServicesView::select()->get();
        return DB::table('service_center_views_services')
            ->select(DB::raw('count(*) as view, services'))
            ->groupBy('services')
            ->orderBy('view', 'desc')
            ->limit(5)
            ->get()
            ->toArray();
    }


    /**
     * Услуги, которыми интересовались в сервисных центрах данного пользователя через диагностику
     * @param $array_id
     * @return mixed
     */
    public function viewByServiceUser($array_id)
    {
        $ids = implode(',', $array_id);

        return DB::table('service_center_views_services')
            ->whereIn('service_center_id', explode(',', $ids))
            ->select(DB::raw('count(*) as view, services'))
            ->groupBy('services')
            ->orderBy('view', 'desc')
            ->get()
            ->toArray();
    }
}