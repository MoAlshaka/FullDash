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

            session()->flash('success', 'تم تسجيل الدخول بنجاح');

            return redirect()->route('admin.dashboard');
        } else {
            // session()->flash('error', 'اسم المستخدم او كلمة المرور غير صحيحة');

            return redirect()->back()->with(['error' => 'اسم المستخدم او كلمة المرور غير صحيحة']);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        session()->invalidate();
        session()->flash('success', 'تم تسجيل الخروج بنجاح');
        return redirect()->route('get.admin.login');
    }
}
