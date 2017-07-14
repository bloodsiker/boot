<?php

namespace App\Http\Controllers;

use App\Facades\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getServiceLogin()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'service_login')->get());
        return view('site.auth.signin_service', compact('data_seo'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postServiceLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->roleSc()){
                AdminLog::log('Ввошел в кабинет сервисного центра');
                return redirect()->route('cabinet.dashboard');
            } elseif (Auth::user()->roleAdmin()){
                AdminLog::log('Ввошел в админский кабинет сервисного центра');
                return redirect()->route('cabinet.admin.user.list');
            }
            Auth::logout();
            return redirect()->back()->with(['message' => 'У Вас нету доступа в эту часть кабинета!']);
        }
        return redirect()->back()->with(['message' => 'Не верные данные для входа в личный кабинет!']);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserLogin()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_login')->get());

        return view('site.auth.signin_user', compact('data_seo'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->roleUser()){
                AdminLog::log('Ввошел в профиль');
                return redirect()->route('user.dashboard');
            }
            Auth::logout();
            return redirect()->back()->with(['message' => 'У Вас нету доступа в эту часть кабинета!']);
        }
        return redirect()->back()->with(['message' => 'Не верные данные для входа в личный кабинет!']);
    }
}
