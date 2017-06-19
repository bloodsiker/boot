<?php

namespace App\Http\Controllers\Admin;

use App\Models\Street;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class StreetController
 * @package App\Http\Controllers\Admin
 */
class StreetController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function getIndex()
   {
       $streets = Street::all();
       $streets->load('city');
       return view('admin.street.index', compact('streets'));
   }

    /**
     * @param Request $request
     */
   public function postStreetCreate(Request $request)
   {

   }
}
