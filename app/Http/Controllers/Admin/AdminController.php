<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\{User, Video};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Admin dashboard';
        $data['total_users'] = User::get()->count();
        $data['total_videos'] = Video::get()->count() ?? 0;
        $data['active_videos'] = Video::where('status', '1')->get()->count() ?? 0;
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
        $data['site_settings'] = Setting::all();
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
    
    public function siteSettings(Request $request)
    {
        $rules = [
            'subscription' => 'required',
            'min_payout' => 'required',
            'max_videos' => 'required',
            'max_videos_ns' => 'required',
            'referral_percentage' => 'required',
            'payout_tax_percentage' => 'required',
        ];

        $request->validate($rules);

        Setting::where('slug', 'subscription')->update(['meta' => $request->subscription]);
        Setting::where('slug', 'min_payout')->update(['meta' => $request->min_payout]);
        Setting::where('slug', 'max_videos')->update(['meta' => $request->max_videos]);
        Setting::where('slug', 'max_videos_ns')->update(['meta' => $request->max_videos_ns]);
        Setting::where('slug', 'referral_percentage')->update(['meta' => $request->referral_percentage]);
        Setting::where('slug', 'payout_tax_percentage')->update(['meta' => $request->payout_tax_percentage]);

        return back()->with('success', 'Site Settings changed successfully!');
    }

}
