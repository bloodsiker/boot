<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getAdmin()
    {
        if(Auth::check() && Auth::user()->role_id == 1){
            return redirect()->route('admin.cabinet');
        }

        if(Auth::check() && Auth::user()->role_id == 5){
            return redirect()->route('crm.cabinet');
        }

        if(Auth::check() && Auth::user()->role_id == 4){
            return redirect()->route('seo.cabinet');
        }

        return redirect()->route('auth.auth');
    }

    public function getAuth()
    {
        return view('auth.auth');
    }

    public function postAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($request->cabinet == 'admin'){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::user()->role_id == 1){
                    return redirect()->route('admin.cabinet');
                }
                return redirect()->back()->with(['message' => 'У вас нету прав доступа в эту часть кабинета!']);
            }
        }

        if($request->cabinet == 'crm'){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::user()->role_id == 1 || Auth::user()->role_id == 5){
                    return redirect()->route('crm.cabinet');
                }
                return redirect()->back()->with(['message' => 'У вас нету прав доступа в эту часть кабинета!']);
            }
        }

        if($request->cabinet == 'seo'){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::user()->role_id == 4 || Auth::user()->role_id == 5){
                    return redirect()->route('seo.cabinet');
                }
                return redirect()->back()->with(['message' => 'У вас нету прав доступа в эту часть кабинета!']);
            }
        }

        return redirect()->back();
    }
}
