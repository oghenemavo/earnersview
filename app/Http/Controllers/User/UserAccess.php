<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAccess extends Controller
{

    public function signup($referral = null)
    {
        $data['page_title'] = "Create an Account";
        $data['referral'] = $referral;
        return view('auth.register', $data);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $request->validate($rules);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['referral_code'] = uniqid();
        
        $user = User::create($data);

        
        Wallet::create(['user_id' => $user->id]);
        
        $referrer = User::where('referral_code', $request->referral)->first();
        if ($referrer) {
            $refer_info = [
                'referrer_user_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'status' => '0'
            ];
            Referral::create($refer_info);
        }
        
        event(new Registered($user));
        auth()->login($user);
        
        return redirect()->to('/');
    }

}
