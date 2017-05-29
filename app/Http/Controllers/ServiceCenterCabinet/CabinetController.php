<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Repositories\ServiceCenter\ServiceCenterRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CabinetController extends Controller
{
    protected $loginPath = '/service-center/login';
    /**
     * @var ServiceCenterRepositoryInterface
     */
    private $sc;

    public function __construct(ServiceCenterRepositoryInterface $sc)
    {
        $this->sc = $sc;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $service_centers = Auth::user()->service_centers;
        //dd($service_centers);
        return view('service_center_cabinet.dashboard', compact('service_centers'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        //dd(Auth::user());
        $service_centers = Auth::user()->service_centers;
        return view('service_center_cabinet.index', compact('service_centers'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getService($id)
    {
        $service_centers = Auth::user()->service_centers;
        if($service_centers->whereIn('id', $id)->isEmpty()){
            return redirect()->back()->with(['message' => 'У вас нету доступа для управлением этим сервисным центром']);
        }
        //$service = ServiceCenter::find($id);
        return view('service_center_cabinet.index', compact('service_centers'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddService()
    {
        $service_centers = Auth::user()->service_centers;
        //dd($service_centers);
        return view('service_center_cabinet.add_service', compact('service_centers'));
    }

    /**
     * Add new Service Center
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddService(Request $request)
    {
        $service_center = $this->sc->addServiceCenter($request);
        return response()->json(['sc_id' => $service_center], 200);
    }

    /**
     * Edit sc cabinet
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function putUpdateService(Request $request, $id)
    {
        $service_center = $this->sc->find($id);

        // Основная информация
        $this->sc->updateServiceCenter($request, $id);

        // Преимущества
        $this->sc->updateAdvantages($request, $id);

        // Теги
        $this->sc->updateTags($request, $id);

         //Бренды
        $this->sc->updateManufacturer($request, $id);

        // Цены
        $this->sc->updatePrice($request, $id);

        return response()->json(['res' => $request->all()], 200);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddPersonalService(Request $request, $id)
    {
        $this->sc->addPersonal($request, $id);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddPhotoService(Request $request, $id)
    {
        $this->sc->addPhoto($request, $id);
    }


    /**
     * Delete personal from Service Center
     * @param $id
     * @param $id_person
     */
    public function deletePersonalService($id, $id_person)
    {
        $this->sc->deletePersonal($id, $id_person);
    }


    /**
     * Delete photo from Service Center
     * @param $id
     * @param $id_photo
     */
    public function deletePhotoService($id, $id_photo)
    {
        $this->sc->deletePhoto($id, $id_photo);
    }


    /**
     * Logout sc cabinet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
