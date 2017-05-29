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
        $sc = ServiceCenter::find($id);

        $file = $request->avatar['data']['base64'];
        $img_name = str_random() . '-' . $sc->service_name . ".jpg";
        Storage::makeDirectory('/sc_uploads/avatars/' . $sc->id);
        $path = "/sc_uploads/avatars/{$sc->id}/";
        $path_img = $path . $img_name;
        Storage::disk('public')->put($path_img, base64_decode($file));

        Image::make(public_path() . $path_img)->resize(500, 500)->save(public_path() . $path_img);

        $sc_personal = [
            'service_center_id' => $sc->id,
            'name' => $request->name,
            'info' => $request->info,
            'path' => $path,
            'avatar' => $img_name
        ];
        DB::table('service_center_personal')->insert($sc_personal);
        return response()->json([$sc_personal], 200);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddPhotoService(Request $request, $id)
    {
        $sc = ServiceCenter::find($id);

        $file = $request->photo['data']['base64'];

        $img_name = str_random() . '-' . $sc->service_name . ".jpg";
        Storage::makeDirectory("/sc_uploads/{$request->type}/{$sc->id}");
        $path = "/sc_uploads/{$request->type}/{$sc->id}/";
        $path_img = $path . $img_name;
        Storage::disk('public')->put($path_img, base64_decode($file));

        Image::make(public_path() . $path_img)->resize(500, 500)->save(public_path() . $path_img);

        $sc_photo = [
            'service_center_id' => $sc->id,
            'path' => $path,
            'file_name' => $img_name,
            'type' => $request->type
        ];

        DB::table('service_center_photo')->insert($sc_photo);
        return response()->json([$sc_photo], 200);
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
