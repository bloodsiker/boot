<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getCabinet()
    {
        return view('admin.index');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('auth.auth');
    }
}
