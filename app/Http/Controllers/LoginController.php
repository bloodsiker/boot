<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AdminLogService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * @var AdminLogService
     */
    private $adminLog;

    /**  Service Center *
     * @param AdminLogService $adminLog
     */

    public function __construct(AdminLogService $adminLog)
    {

        $this->adminLog = $adminLog;
    }

    public function getServiceLogin()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'service_registration')->get());

        return view('site.auth.signin_service', compact('data_seo'));
    }

    public function postServiceLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->roleSc()){
                $this->adminLog->log('Ввошел в кабинет сервисного центра');
                return redirect()->route('cabinet.dashboard');
            } elseif (Auth::user()->roleAdmin()){
                $this->adminLog->log('Ввошел в админский кабинет сервисного центра');
                return redirect()->route('cabinet.admin.user.list');
            }
            Auth::logout();
            return redirect()->back()->with(['message' => 'У Вас нету доступа в эту часть кабинета!']);
        }
        return redirect()->back()->with(['message' => 'Не верные данные для входа в личный кабинет!']);
    }
}
