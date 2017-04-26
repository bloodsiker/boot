<?php

namespace App\Http\Controllers\Admin;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function getIndex()
    {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }

    public function postCityCreate(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required|max:255|min:2'
        ]);

        $city = new City;
        $city->city_name = $request->city_name;
        $city->metro = $request->metro;
        $city->slug = str_slug($request->city_name, '-');
        $message = 'Ошибка при добавлении города';
        if($city->save()){
            $message = "Город $city->city_name успешно добавлен";
            return redirect()->back()->with(['message' => $message]);
        }
        return redirect()->back()->with(['message' => $message]);
    }
}
