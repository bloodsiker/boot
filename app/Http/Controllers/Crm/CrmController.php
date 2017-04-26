<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CrmController extends Controller
{
    public function getCabinet()
    {
        return view('crm_cabinet.index');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('auth.auth');
    }
}
