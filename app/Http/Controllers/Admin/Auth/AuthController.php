<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function get_admin_login()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:admins,username|max:50',
            'password' => 'required|max:50',

        ]);


        if (auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {


            $message = trans('auth.SuccessLogin');
            $notification = array(
                'message' => $message,
                'alert-type' => 'success'
            );

            return redirect()->route('admin.dashboard')->with($notification);
        } else {

            $message = trans('auth.ErrorLogin');
            $notification = array(
                'message' => $message,
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        session()->invalidate();
        $message = trans('auth.SuccessLogout');
        $notification = array(
            'message' => $message,
            'alert-type' => 'success'
        );
        return redirect()->route('get.admin.login')->with($notification);
    }
}
