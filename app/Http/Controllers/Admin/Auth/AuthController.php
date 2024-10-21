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
        ], [
            'username.required' => 'حقل اسم المستخدم مطلوب.',
            'username.exists' => 'اسم المستخدم غير موجود في النظام.',
            'username.max' => 'اسم المستخدم يجب ألا يتجاوز 50 حرفًا.',

            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.max' => 'كلمة المرور يجب ألا تتجاوز 50 حرفًا.',
        ]);


        if (auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {

            session()->flash('success', 'تم تسجيل الدخول بنجاح');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'اسم المستخدم او كلمة المرور غير صحيحة');

            return redirect()->back();
        }
    }

    public function logout()
    {
        auth()->logout();
        flash()->success('تم تسجيل الخروج بنجاح');
        return redirect()->route('get.admin.login');
    }
}
