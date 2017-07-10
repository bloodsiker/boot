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

        $user = $service->createOrGetUser(Socialite::driver('facebook')->user(), $role->id);

        auth()->login($user);

        if(Auth::user()->roleSc()){

            return redirect()->route('cabinet.dashboard');

        } elseif (Auth::user()->roleUser()){

            return redirect()->route('user.dashboard');

        }

    }
}
