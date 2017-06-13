<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Repositories\ServiceCenter\ServiceCenterRepositoryInterface;
use App\Repositories\VisitsServiceCenter\VisitsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CabinetController extends Controller
{
    protected $loginPath = '/service-center/login';
    /**
     * @var ServiceCenterRepositoryInterface
     */
    private $sc;
    /**
     * @var VisitsRepositoryInterface
     */
    private $visitsRepository;

    public function __construct(ServiceCenterRepositoryInterface $sc, VisitsRepositoryInterface $visitsRepository)
    {
        $this->sc = $sc;
        $this->visitsRepository = $visitsRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $end = Carbon::now()->toDateString();
        $start = Carbon::now()->addDay(-7)->toDateString();
        $service_centers = Auth::user()->service_centers->toArray();
        $visits = [];
        foreach ($service_centers as $sc){
            $visits[$sc['service_name']] = $this->visitsRepository->visitsBetween($sc['id'], $start, $end);
        }
        dd($visits);

        return view('service_center_cabinet.dashboard');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSettings()
    {
        return view('service_center_cabinet.settings');
    }


    /**
     * @param Request $request
     */
    public function postSettings(Request $request)
    {
        return $this->sc->updateSetting($request);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('service_center_cabinet.index');
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
        return view('service_center_cabinet.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddService()
    {
        return view('service_center_cabinet.add_service');
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddLogo(Request $request, $id)
    {
        $sc_logo = $this->sc->addLogo($request, $id);
        return response()->json([$sc_logo], 200);
    }

    /**
     * Edit sc cabinet
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function putUpdateService(Request $request, $id)
    {
        // Основная информация
        $this->sc->updateServiceCenter($request, $id);

        // Рабочий график
        $this->sc->updateWorkingDays($request, $id);

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
     * Logout sc cabinet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
