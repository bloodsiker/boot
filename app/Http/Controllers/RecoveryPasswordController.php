<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class RecoveryPasswordController extends Controller
{
    use ResetsPasswords;

    public function getRecovery()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_password_reset')->get());
        return view('site.auth.password.email', compact('data_seo'));
    }


    public function sendResetLinkEmail()
    {
        return redirect()->back();
    }
}
