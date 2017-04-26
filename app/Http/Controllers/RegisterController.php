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

    public function getUserIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'service_registration')->get());
        return view('');
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
