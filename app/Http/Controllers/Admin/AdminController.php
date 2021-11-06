<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Admin dashboard';
        return view('admin.dashboard.index', $data);
    }
    
    public function users()
    {
        $data['page_title'] = 'App users';
        return view('admin.dashboard.users', $data);
    }

    public function activateUser(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->is_active = '1';

        $result = $user->save();
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['fail' => true]);
    }

    public function suspendUser(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->is_active = '0';

        $result = $user->save();
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['fail' => true]);
    }

    public function settings()
    {
        $data['page_title'] = 'Admin Settings';
        return view('admin.dashboard.settings', $data);
    }
    
    public function updatePassword(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $rules = [
            'current' => [
                'required',
                function ($attribute, $value, $fail) use($user) {
                    $current_password = $user->password;
                    if (!Hash::check($value, $current_password)) {
                        $fail('This not the '. $attribute);
                    }
                },
            ],
            'password' => 'required|min:5',
            'repeat' => 'required|same:password',
        ];

        $attributes = [
            'current' => 'Current Password',
            'password' => 'New Password',
            'repeat' => 'Repeat Password',
        ];

        $request->validate($rules, [], $attributes);
        
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if ($result) {
            return back()->with('primary', 'Password Updated Successfully!');
        }
        return back()->with('danger', 'Unable to Update Password!');
    }
    
    public function emailPassword(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($user->id)
            ],
        ];

        $request->validate($rules);
        
        $user->email = $request->email;
        $user->save();

        if ($user->isDirty()) {
            return back()->with('success', 'Account Email changed successfully!');
        }
        return back()->with('info', 'No changes made!');
    }

}
