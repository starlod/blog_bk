<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Auth;
use View;
use DB;

class UserController extends Controller
{
    /**
     * プロフィール 表示
     *
     * @param Integer $id
     * @return View
     */
    public function profile()
    {
        $user = Auth::user();
        return View::make('users.profile')->with(compact('user'));
    }

    /**
     * プロフィール 更新
     *
     * @param Request $request
     * @return Redirect to user profile
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $user = $user->update($request->all());
        message('messages.updated', ['name' => 'プロフィール'], 'success');

        return redirect("/profile");
    }

    /**
     * パスワード変更 表示
     *
     * @param Integer $id
     * @return View
     */
    public function changePassword()
    {
        $user = Auth::user();
        return View::make('users.change_password')->with(compact('user'));
    }

    /**
     * パスワード変更 更新
     *
     * @param ChangePasswordRequest $request
     * @return Redirect to user profile
     */
    public function changePasswordUpdate(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if ($user->password !== bcrypt($request->current_password)) {
            $this->warning('messages.not_match_current_password', ['name' => 'ユーザー']);
        }

        $user = $user->update($request->all());
        message('messages.updated', ['name' => 'プロフィール'], 'success');

        return redirect("/profile");
    }
}
