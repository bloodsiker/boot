<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    /** User **/

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_registration')->get());
        return view('site.auth.signup_user', compact('data_seo'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserRegister(Request $request)
    {
        $role_id = 3;
//        $this->validate($request, [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:users',
//            'password' => 'required|min:4'
//        ]);

        $findUser = User::whereEmail($request->email)->first();
        if($findUser){

            return redirect()->back()->with(['message' => 'Пользователь с таким email уже зарегистрирован!']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $role_id;

        $user->save();
        Auth::login($user, true);

        return redirect()->route('cabinet');
    }


    /**  Service Center **/

    public function getServiceRegister()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'service_registration')->get());

        return view('site.auth.signup_service', compact('data_seo'));
    }

    public function postServiceRegister(Request $request)
    {
        $role_id = 2;
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $role_id;

        $user->save();
        Auth::login($user, true);

        return redirect()->route('cabinet');
    }

}
