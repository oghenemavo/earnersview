<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile()
    {
        $data['page_title'] = 'User Profile';
        return view('user.dashboard.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
        ];
        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($user->isDirty()) {
            return back()->with('success', 'Profile changed successfully!');
        }
        return back()->with('info', 'No changes made!');
    }

    public function account()
    {
        $data['page_title'] = 'Edit Account';
        return view('user.dashboard.account', $data);
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'banks' => 'required',
            'account_number' => 'required',
        ];
        $request->validate($rules);

        $user->bank_code = $request->banks;
        $user->bank_account = $request->account_number;
        $user->save();

        if ($user->isDirty()) {
            return back()->with('success', 'Financial Details changed successfully!');
        }
        return back()->with('info', 'No changes made!');
    }

    public function settings()
    {
        $data['page_title'] = 'Settings';
        return view('user.dashboard.settings', $data);
    }

    public function changeSettings(Request $request)
    {
        $rules = [
            'current' => [
                'required',
                function ($attribute, $value, $fail) {
                    $current_password = auth()->user()->password;
                    if (!Hash::check($value, $current_password)) {
                        $fail('This not the ' . $attribute . ' password');
                    }
                },
            ],
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
        ];

        $attributes = [
            'current' => 'Current Password',
            'password' => 'New Password',
            'password_confirmation' => 'Repeat Password',
        ];

        $request->validate($rules, [], $attributes);
        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $result = $user->save();
        if ($result) {
            return back()->with('success', 'Password Updated Successfully!');
        }
        return back()->with('success', 'Unable to Update Password!');
    }
}
