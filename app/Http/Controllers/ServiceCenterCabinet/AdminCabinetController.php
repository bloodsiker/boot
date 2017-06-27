<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Models\ServiceCenter;
use App\Models\User;
use App\Repositories\ServiceCenter\ServiceCenterRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCabinetController extends Controller
{
    /**
     * @var ServiceCenterRepositoryInterface
     */
    private $centerRepository;

    public function __construct(ServiceCenterRepositoryInterface $centerRepository)
    {

        $this->centerRepository = $centerRepository;
    }

    /**
     * Login Admin-user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserList()
    {
        $list_user = User::where('role_id', 2)->get();
        dd($list_user);
        return view('service_center_cabinet.dashboard');
    }


    public function getUserListSc($id)
    {
        $list_user_sc = ServiceCenter::where('user_id', $id)->get();
        dd($list_user_sc);
        return view('service_center_cabinet.dashboard');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getService($id)
    {
        $service_id = $this->centerRepository->find($id);
        $service = ServiceCenter::where('id', $id)->select('service_name')->first();
        $service_name = $service->service_name;
        dd($service_id);
        return view('service_center_cabinet.index', compact('service_name'));
    }
}
