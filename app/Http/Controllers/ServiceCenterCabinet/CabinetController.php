<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CabinetController extends Controller
{
    protected $loginPath = '/service-center/login';

    public function getDashboard()
    {
        $service_centers = Auth::user()->service_centers;
        //dd($service_centers);
        return view('service_center_cabinet.dashboard', compact('service_centers'));
    }

    public function getIndex()
    {
        //dd(Auth::user());
        $service_centers = Auth::user()->service_centers;
        return view('service_center_cabinet.index', compact('service_centers'));
    }

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

    public function getAddService()
    {
        $service_centers = Auth::user()->service_centers;
        return view('service_center_cabinet.add_service', compact('service_centers'));
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
