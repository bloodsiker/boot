<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Models\FormRequest;
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
        $list_user = User::where('role_id', 2)->orderBy('users.last_online', 'desc')->get();
        return view('service_center_cabinet.admin.users', compact('list_user'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserListSc($id)
    {
        $list_user_sc = ServiceCenter::where('user_id', $id)->get();
        return view('service_center_cabinet.admin.user_list_sc', compact('list_user_sc'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListSc()
    {
        $list_user_sc = ServiceCenter::all();
        return view('service_center_cabinet.admin.user_list_sc', compact('list_user_sc'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getService($id)
    {
        $service = ServiceCenter::where('id', $id)->select('service_name')->first();
        $service_name = $service->service_name;
        return view('service_center_cabinet.index', compact('service_name', 'id'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMessages()
    {
        return view('service_center_cabinet.admin.messages');
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function allRequest()
    {
        $all = FormRequest::select('id', 'email', 'name', 'created_at', 'phone', 'services', 'status_id', 'manufacturer', 'favorite', 'service_center_id')
            ->orderBy('id', 'desc')->get();
        $all->load('status', 'service_center');

        return response($all);
    }
}
