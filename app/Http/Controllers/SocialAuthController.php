<?php

namespace App\Http\Controllers;

use App\Facades\AdminLog;
use App\Models\Role;
use App\Services\SocialAccountService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Session;

/**
 * Class SocialAuthController
 * @package App\Http\Controllers
 */
class SocialAuthController extends Controller
{
    public function auth()
    {
        return view('auth');
    }

    /**
     * Auth Facebook
     * @return mixed
     */
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Auth Facebook
     * @param SocialAccountService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function facebookCallback(SocialAccountService $service)
    {
        if(Session::has('social_facebook')){
            $service->linkSocialAccount(Socialite::driver('facebook')->user(), 'facebook');
            Session::forget('social_facebook');
            return redirect()->route('user.setting')->with(['message' => ' facebook аккаунт привязан']);
        }
        $role = Role::where('role', 'user')->first();

        $user = $service->createOrGetUser(Socialite::driver('facebook')->user(), 'facebook', $role->id);

        auth()->login($user);
        AdminLog::log('Ввошел в профиль через facebook');

        return redirect()->route('user.dashboard');
    }



    /**
     * Auth google
     * @return mixed
     */
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Auth Google
     * @param SocialAccountService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function googleCallback(SocialAccountService $service)
    {
        if(Session::has('social_google')){
            $service->linkSocialAccount(Socialite::driver('google')->user(), 'google');
            Session::forget('social_google');
            return redirect()->route('user.setting')->with(['message' => ' google аккаунт привязан']);
        }
        $role = Role::where('role', 'user')->first();

        $user = $service->createOrGetUser(Socialite::driver('google')->user(), 'google', $role->id);

        auth()->login($user);
        AdminLog::log('Ввошел в профиль через google');

        return redirect()->route('user.dashboard');
    }


    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Auth Google
     * @param SocialAccountService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function linkedinCallback(SocialAccountService $service)
    {
        if(Session::has('social_linkedin')){
            $service->linkSocialAccount(Socialite::driver('linkedin')->user(), 'linkedin');
            Session::forget('social_linkedin');
            return redirect()->route('user.setting')->with(['message' => ' linkedin аккаунт привязан']);
        }
        $role = Role::where('role', 'user')->first();

        $user = $service->createOrGetUser(Socialite::driver('linkedin')->user(), 'linkedin', $role->id);

        auth()->login($user);
        AdminLog::log('Ввошел в профиль через linkedin');

        return redirect()->route('user.dashboard');
    }
}
