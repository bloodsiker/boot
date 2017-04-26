<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getIndex()
    {
        $users = User::where('role_id','<>', 3)->get()->sortByDesc("id");
        //$users = User::with('role')->get();
        $users->load('role');
        return view('admin.user.index', compact('users'));
    }

    public function getUserCreate()
    {
        return view('admin.user.create');
    }

    public function postUserCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User();
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $message = 'Ошибка при добавлении пользователя';
        if($user->save()){
            $message = 'Пользователь успешно добавлен';
            return redirect()->route('admin.users')->with(['message' => $message]);
        }
        return redirect()->route('admin.user.create')->with(['message' => $message]);
    }

    public function getUserEdit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function postUserEdit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id
        ]);
        $user = User::find($id);
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->update()){
            return redirect()->route('admin.users')->with(['message' => 'Данные пользователя обновленны!']);
        }
        return redirect()->back();
    }

    public function getUserDelete($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->delete();
        return redirect()->route('admin.users')->with(['message' => 'Пользователь удален!']);
    }
}
