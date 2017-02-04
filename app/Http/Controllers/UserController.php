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
        if ($user = Auth::user()) {
            return View::make('users.profile')->with(compact('user'));
        }

        $this->warning('messages.not_found', ['name' => 'ユーザー']);

        return redirect('/');
    }

    /**
     * プロフィール 更新
     *
     * @param Request $request
     * @return Redirect to user profile
     */
    public function profileUpdate(Request $request)
    {
        if ($user = Auth::user()) {

            DB::beginTransaction();

            $user = $user->update($request->all());
            $this->success('messages.updated', ['name' => 'プロフィール']);

            DB::commit();
        }

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
        if ($user = Auth::user()) {
            return View::make('users.change_password')->with(compact('user'));
        }

        $this->warning('messages.not_found', ['name' => 'ユーザー']);

        return redirect('/');
    }

    /**
     * パスワード変更 更新
     *
     * @param ChangePasswordRequest $request
     * @return Redirect to user profile
     */
    public function changePasswordUpdate(ChangePasswordRequest $request)
    {
        if ($user = Auth::user()) {

            DB::beginTransaction();

            $user = $user->update($request->all());
            $this->success('messages.updated', ['name' => 'プロフィール']);

            DB::commit();
        }

        return redirect("/profile");
    }
}
