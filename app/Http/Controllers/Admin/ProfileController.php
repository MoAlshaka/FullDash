<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {

        return view('admin.auth.profile');
    }
    public function update_profile(ProfileUpdateRequest $request, $id)
    {

        $admin = Admin::findorfail($id);
        $exists_username = Admin::where(['username' => $request->username])->where('id', '!=', $id)->first();
        if ($exists_username) {
            return redirect()->back()->with(['warning' => 'اسم مستخدم موجود بالفعل']);
        }
        $exists_phone = Admin::where(['phone' => $request->phone])->where('id', '!=', $id)->first();
        if ($exists_phone) {
            return redirect()->back()->with(['warning' => 'الهاتف  موجود بالفعل']);
        }


        $old_image = $admin->image;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/admins/images'), $image_name);
            if ($admin->image && file_exists(public_path('assets/admins/images/' . $admin->image))) {
                unlink(public_path('assets/admins/images/' . $admin->image));
            }
        }


        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone ?? null,
            'image' => $image_name ?? $old_image,
        ]);
        return redirect()->route('admin.profile')->with(['success' => 'تم تحديث البيانات بنجاح  ']);
    }
    public function change_password(PasswordUpdateRequest $request, $id)
    {


        $admin = Admin::findOrFail($id);

        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->back()->withInput()->with(['pass_error' => 'كلمه السر القديمة غير صحيحة']);
        }

        $admin->update([
            'password' => bcrypt($request->new_password),
        ]);
        return redirect()->route('admin.profile')->with('success', 'تم تغير كلمه السر بنجاح');
    }
}
