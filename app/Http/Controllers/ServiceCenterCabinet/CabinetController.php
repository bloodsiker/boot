<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
            echo "<script>alert('access denied')</script>";
            return redirect()->route('cabinet.dashboard');
        }
        $service = ServiceCenter::find($id);
        //dd($service);
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
        $sc = new ServiceCenter();
        $sc->service_name = $request->name;
        $sc->user_id = Auth::id();
        $sc->city_id = $request->city;
        $sc->metro_id = $request->metro;
        $sc->district_id = $request->district;
        $sc->street = $request->street;
        $sc->c1 = $request->c1;
        $sc->c2 = $request->c2;
        $sc->created_at = Carbon::now();
        $sc->save();
        return response()->json(['sc_id' => $sc->id], 200);
    }

    public function putUpdateService(Request $request, $id)
    {
        $sc = ServiceCenter::find($id);

        $sc->service_name = $request->service_name;
        $sc->about = $request->about;
        $sc->city_id = $request->city_id;
        $sc->metro_id = $request->metro_id;
        $sc->district_id = $request->district_id;
        $sc->address = 'Украина, ' . $request->city['city_name'] . ', ' . $request->street;
        $sc->street = $request->street;
        $sc->c1 = $request->c1;
        $sc->c2 = $request->c2;
        $sc->updated_at = Carbon::now();
        $sc->update();

         //Преимущества
        DB::table('service_center_advantages')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($request->advantages as $advantage){
            DB::table('service_center_advantages')->insert(
                [
                    'service_center_id' => $sc->id,
                    'advantages' => $advantage['advantages']
                ]);
        }

        //Теги
        DB::table('service_center_vs_tags')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($request->tags as $tag){
            DB::table('service_center_vs_tags')->insert(
                [
                    'service_center_id' => $sc->id,
                    'tag' => $tag['tag']
                ]);
        }

         //Бренды
        DB::table('service_center_vs_manufacturer')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($request->manufacturers as $manufacturer){
            DB::table('service_center_vs_manufacturer')->insert(
                [
                    'service_center_id' => $sc->id,
                    'manufacturer_id' => $manufacturer['id']
                ]);
        }

        // Цены
        DB::table('service_center_price')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($request->price as $price){
            DB::table('service_center_price')->insert(
                [
                    'service_center_id' => $sc->id,
                    'title' => $price['title'],
                    'price' => $price['price']
                ]);
        }

        return response()->json(['res' => $request->all()], 200);
    }


    public function postAddPersonalService(Request $request, $id)
    {
        $sc = ServiceCenter::find($id);

        $file = $request->avatar['data']['base64'];
        $png_url = "perfil-" . time() . ".jpg";
        $path = '/sc_uploads/avatars/' . $png_url;
        Storage::disk('public')->put('/sc_uploads/avatars/' . $png_url, base64_decode($file));


        $arr = [
            'service_center_id' => $sc->id,
            'name' => $request->name,
            'info' => $request->info,
            'avatar' => $path
        ];
        DB::table('service_center_personal')->insert($arr);
        return response()->json([$arr], 200);


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
