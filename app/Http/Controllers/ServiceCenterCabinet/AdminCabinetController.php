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
    private $sc;

    public function __construct(ServiceCenterRepositoryInterface $sc)
    {

        $this->sc = $sc;
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
        return view('service_center_cabinet.admin.service_center', compact('service_name', 'id'));
    }


    public function putUpdateService(Request $request, $id)
    {
        // Основная информация
        if($request->has('info')){
            $this->sc->updateServiceCenter($request, $id);
        }

        if($request->has('about')){
            $this->sc->updateAboutServiceCenter($request, $id);
        }

        // Рабочий график
        if($request->has('work_days')){
            $this->sc->updateWorkingDays($request, $id);
        }

        // Телефоны
        if($request->has('phones')){
            $this->sc->updatePhones($request, $id);
        }

        //Emails
        if($request->has('emails')){
            $this->sc->updateEmails($request, $id);
        }

        // Преимущества
        if($request->has('advantages')){
            $this->sc->updateAdvantages($request, $id);
        }

        // Теги
        if($request->has('tags')){
            $this->sc->updateTags($request, $id);
        }

        //Бренды
        if($request->has('manufacturers')){
            $this->sc->updateManufacturer($request, $id);
        }

        // Цены
        if($request->has('price')){
            $this->sc->updatePrice($request, $id);
        }

        return response()->json(['res' => $request->all()], 200);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddPersonalService(Request $request, $id)
    {
        $sc_personal = $this->sc->addPersonal($request, $id);
        return response()->json([$sc_personal], 200);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddPhotoService(Request $request, $id)
    {
        $sc_photo = $this->sc->addPhoto($request, $id);
        return response()->json([$sc_photo], 200);
    }


    /**
     * Delete personal from Service Center
     * @param $id
     * @param $id_person
     * @return string
     */
    public function deletePersonalService($id, $id_person)
    {
        $this->sc->deletePersonal($id, $id_person);
        return json_encode(["status" => 200]);
    }


    /**
     * Delete photo from Service Center
     * @param $id
     * @param $id_photo
     * @return string
     */
    public function deletePhotoService($id, $id_photo)
    {
        $this->sc->deletePhoto($id, $id_photo);
        return json_encode(["status" => 200]);
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
