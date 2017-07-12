<?php

namespace App\Http\Controllers\UserProfile;

use App\Models\FormRequestMessage;
use App\Models\User;
use App\Services\AdminLogService;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{

    /**
     * @var AdminLogService
     */
    private $adminLog;

    public function __construct(AdminLogService $adminLog)
    {

        $this->adminLog = $adminLog;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_dashboard')->get());

        $last_messages = DB::table('form_request_message')
            ->leftJoin('form_requests', function ($join) {
                $join->on('form_requests.id', '=', 'form_request_message.request_id')
                    ->whereNotNull('form_request_message.service_center_id');
            })
            ->leftJoin('service_centers', function ($join) {
                $join->on('service_centers.id', '=', 'form_request_message.service_center_id')
                    ->whereNotNull('form_request_message.service_center_id');
            })

            ->select('form_request_message.id',
                'service_centers.service_name',
                'service_centers.logo',
                'form_requests.r_id',
                'form_request_message.message',
                'form_request_message.created_at')
            ->where('form_requests.user_id', Auth::user()->id)
            ->orderByDesc('form_request_message.id')
            ->take(5)
            ->get();

        //dd($last_messages);

        return view('user_profile.index', compact('data_seo', 'last_messages'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_profile')->get());
        return view('user_profile.profile', compact('data_seo'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->about_me = $request->about_me;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = '/user_upload/avatars/';
            $destinationPath =  public_path() . $path;
            $filename = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
            if ($request->hasFile('avatar')) {
                $request->file('avatar')->move($destinationPath, $filename);
                Image::make(public_path() . $path . $filename)->resize(200, 200)->save(public_path() . $path . $filename);
            }

            $user->avatar = $path . $filename;
        }
        $user->update();

        return redirect()->back()->with(['message' => 'Профиль обновлен!']);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSetting()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_setting')->get());
        return view('user_profile.setting', compact('data_seo'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSetting(Request $request)
    {
        $user = User::find(Auth::id());

        if(!empty($user->password)){
            if (Hash::check($request->old_password, $user->password) == false) {
                return redirect()->back()->with(['error' => 'Не верный текущий пароль']);
            }
        }

        if($request->password != $request->password_confrim){
            return redirect()->back()->with(['error' => 'Пароли не совпадают']);
        }

        $user->password = bcrypt($request->password);

        if($user->update()){
            return redirect()->back()->with(['message' => 'Новый пароль успешно сохранен']);
        }
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        $this->adminLog->log('Вышел из провиля');
        Auth::logout();
        return redirect()->route('user.login');
    }
}
