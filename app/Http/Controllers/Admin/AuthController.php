<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        $data['page_title'] = 'Admin Login';
        return view('admin.auth.login', $data);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credientials = $request->only('email', 'password');
        if (auth()->guard('admin')->attempt($credientials)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request) 
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    
    public function forgot()
    {
        $data['page_title'] = 'Forgot Password';
        return view('admin.auth.forgot', $data);
    }

    public function recover(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $request->validate($rules);

        $string = Str::random(12);
        $token = Crypt::encrypt($string);
        
        $user = Admin::where('email', $request->email)->first();
        
        if ($user) {
            $reset = [
                'email' => $request->email,
                'token' => $string,
                'created_at' => Carbon::now(),
            ];

            $data = [
                'url' => route('admin.reset.forgot.password', urlencode($token)),
                'name' => $user->name,
            ];

            DB::table('password_resets')->insert($reset);

            Mail::send('email.reset', $data, function($message) use($user)
            {
                $message->to($user->email, $user->name)->subject('Reset Forgotten Password');
                // $message->from('karlosray@gmail.com', 'Alex');
            });
            return back()->with('primary', 'Reset instructions have been sent to your email');
        }
        return back()->with('info', 'If we find an account with this email we would forward instructions');
    }
    
    public function resetForgotPassword($token)
    {
        $token = urldecode($token);
        $string = Crypt::decrypt($token);
        $user = DB::table('password_resets')->where('token', $string)->first();
        if ($user) {
            $data['page_title'] = 'Reset Forgotten Password';
            $data['email'] = $user->email;
            return view('admin.auth.reset', $data);
        }
        return redirect()->route('admin.forgot.password')->with('info', 'Unable to reset password right now, try again');
    }
    
    public function reset(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:5',
            'repeat_password' => 'required|same:password',
        ];
        $attributes = [
            'password' => 'New Password',
            'repeat_password' => 'Repeat Password',
        ];
        $request->validate($rules, [], $attributes);

        $result = DB::transaction(function() use($request) {
            $email = $request->email;

            $user = Admin::where('email', $email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return DB::table('password_resets')->where(['email'=> $email])->delete();
        });

        if ($result) {
            return redirect()->route('admin.login')->with('primary', 'Password Reset Successful, Log in');
        }
        return redirect()->back()->with('warning', 'unable to Reset Password');
    }
}
