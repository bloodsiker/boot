<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Services\SocialAccountService;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
        $role = Role::where('role', 'user')->first();

        $user = $service->createOrGetUser(Socialite::driver('facebook')->user(), 'facebook', $role->id);

        auth()->login($user);

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
        $role = Role::where('role', 'user')->first();

        $user = $service->createOrGetUser(Socialite::driver('google')->user(), 'google', $role->id);

        auth()->login($user);

        return redirect()->route('user.dashboard');
    }
}
