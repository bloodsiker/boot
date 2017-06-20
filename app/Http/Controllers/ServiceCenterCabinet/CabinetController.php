<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Models\ServiceCenter;
use App\Repositories\ServiceCenter\ServiceCenterRepositoryInterface;
use App\Repositories\ServicesView\ServicesViewRepositoryInterface;
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
    /**
     * @var ServicesViewRepositoryInterface
     */
    private $servicesView;

    public function __construct(ServiceCenterRepositoryInterface $sc,
                                VisitsRepositoryInterface $visitsRepository,
                                ServicesViewRepositoryInterface $servicesView)
    {
        $this->sc = $sc;
        $this->visitsRepository = $visitsRepository;
        $this->servicesView = $servicesView;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {

        return view('service_center_cabinet.dashboard');
    }


    /**
     * @return array
     */
    public function getDashboardStat()
    {
        $end = Carbon::now()->toDateString();
        $start = Carbon::now()->addDay(-30)->toDateString();
        $service_centers = Auth::user()->service_centers->toArray();
        $statistic = [];
        foreach ($service_centers as $sc){
            $statistic['visits'][$sc['service_name']] = $this->visitsRepository->visitsBetween($sc['id'], $start, $end);
        }
        $statistic['top_services'] = $this->servicesView->topViewServices();

        $array_id = array_column($service_centers, 'id');
        $statistic['services_by_service'] = $this->servicesView->viewByServiceUser($array_id);

        return $statistic;
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
        if(Auth::user()->roleSc()){
            $service_centers = Auth::user()->service_centers;
            if($service_centers->whereIn('id', $id)->isEmpty()){
                return redirect()->back()->with(['message' => 'У вас нету доступа для управлением этим сервисным центром']);
            }
        }
        $service = ServiceCenter::where('id', $id)->select('service_name')->first();
        $service_name = $service->service_name;
        return view('service_center_cabinet.index', compact('service_name'));
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
     * Disabled service center
     * @param Request $request
     * @param $id
     * @return string
     */
    public function disabledService(Request $request, $id)
    {
        $service_centers = Auth::user()->service_centers;
        if($service_centers->whereIn('id', $id)->isEmpty()){
            return redirect()->back()->with(['message' => 'У вас нету доступа для управлением этим сервисным центром']);
        }
        $sc = ServiceCenter::find($id);
        $sc->enabled = 1;
        if($sc->update()){
            return json_encode(["status" => 200]);
        }
        return json_encode(["status" => 400]);
    }

    /**
     * Enabled service center
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function enabledService(Request $request, $id)
    {
        $service_centers = Auth::user()->service_centers;
        if($service_centers->whereIn('id', $id)->isEmpty()){
            return redirect()->back()->with(['message' => 'У вас нету доступа для управлением этим сервисным центром']);
        }
        $sc = ServiceCenter::find($id);
        $sc->enabled = 0;
        if($sc->update()){
            return json_encode(["status" => 200]);
        }
        return json_encode(["status" => 400]);
    }


    /**
     * List disabled
     * @return string
     */
    public function listDisabledService()
    {
        $service_centers = Auth::user()->service_centers()->enabled(1)->get();
        return json_encode($service_centers);
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
