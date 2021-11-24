<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Library\Facades\FlutterwaveFacade;
use App\Models\Membership;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoLog;
use Carbon\Carbon;
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
        $user = auth()->guard('web')->user();
        $rules = [
            'current' => [
                'required',
                function ($attribute, $value, $fail) use($user) {
                    $current_password = $user->password;
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

        $user->password = Hash::make($request->password);
        $result = $user->save();
        if ($result) {
            return back()->with('success', 'Password Updated Successfully!');
        }
        return back()->with('success', 'Unable to Update Password!');
    }

    public function setMembership()
    {
        $transaction = [
            'details' => 'Membership',
            'email' =>  auth()->guard('web')->user()->email,
            'name' =>  auth()->guard('web')->user()->name,
            'amount' => env('SUBSCRIPTION_FEE'),
            'tx_ref' => strtolower(bin2hex(openssl_random_pseudo_bytes(10))),
            'user_id' => auth()->guard('web')->user()->id,
        ];

        if (Transaction::create($transaction)) {
            FlutterwaveFacade::gateway($transaction);
        }
    }

    public function paymentProcess(Request $request)
    {
        $result = FlutterwaveFacade::process($request);
        if ($result) {
            $user_id = $result->data->meta->user_id;
            $tx_ref = $result->data->tx_ref;
            $total_amount = $result->data->amount;

            Transaction::where('tx_ref', $tx_ref)->update(['is_confirmed' => '1', 'confirmed_at' => date('Y-m-d H:i:s')]);
            

            // Retrieve flight by name or instantiate with the name, delayed, and arrival_time attributes...
            $membership = Membership::firstOrCreate(
                ['user_id' => $user_id],
                ['reference' => $tx_ref, 'amount' => $total_amount,]
            );

            if ($membership) {
                return back()->with('success', 'payment successful, you have subscribed');
            }

            
            // send email
            // $notification = [];
            // $dbOrders = Order::where('transaction_id', $orders[0]['transaction_id'])->get();
            // foreach ($dbOrders as $order) {
            //     $data['order'] = $order;
                
            //     $html = view('email.ticket-receipt', $data)->render();
            //     $notification[] = [
            //         'email' => $order->email,
            //         'name' => $order->lastname . ' ' . $order->firstname,
            //         'subject' => 'Ticket ' . $order->event->title,
            //         'body' => $html,
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //     ];
            // }
    
            // if (count($notification)) {
            //     Notification::insert($notification);
            // }
            
            // if ($result) {
            //     // if ($request->session()->has('cart')) {
            //     //     $request->session()->forget('cart');
            //     // }
    
            //     // $request->session()->flash('paid', 'Ticket Purchased successfully');
    
            //     // if ($referral) {
            //     //     $this->referralOrderProcess($referral, $total_amount);
            //     //     return redirect()->route('order.referral', $referral);
            //     // }
            //     return back();
            // }
        }
        return redirect()->to('/');
    }

    public function logVideo(Request $request, Video $video)
    {
        $user = auth()->guard('web')->user();

        $played = $request->played;

        $validPlayed = filter_var($played, FILTER_VALIDATE_FLOAT, [
            'options' => [
                'min_range' => $video->earned_after, 
                'max_range' => $played,
            ]
        ]);

        if ($validPlayed) {
            $log = [
                'user_id' => $user->id,
                'video_id' => $video->id,
                'watched' => $played,
                'credit' => $video->earnable,
            ];
            
            $i = VideoLog::firstOrCreate(
                ['user_id' => $user->id, 'video_id' => $video->id],
                $log
            );
            
            if ($i->wasRecentlyCreated) {
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
        }
        return response()->json(['error' => true]);
    }

    public function requestPayout(Request $request)
    {
        $user = auth()->guard('web')->user();
        $balance = $request->balance;
        $user->wallet->balance = '0.00';
        $user->wallet->ledger_balance += $balance;
        if ($user->wallet->save()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

}
