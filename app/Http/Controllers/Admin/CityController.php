<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CityController
 * @package App\Http\Controllers\Admin
 */
class CityController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCityCreate(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required|max:255|min:2'
        ]);

        $city = new City;
        if(City::where('city_name', $request->city_name)){
            return redirect()->back()->with(['error' => 'Город (' . $request->city_name . ') уже есть в базе']);
        }
        $city->city_name = $request->city_name;
        $city->metro = $request->metro;
        $city->slug = str_slug($request->city_name, '-');
        if($city->save()){
            return redirect()->back()->with(['message' => "Город $city->city_name успешно добавлен"]);
        }
        return redirect()->back()->with(['message' => 'Ошибка при добавлении города']);
    }
}
