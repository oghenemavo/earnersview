<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Facades\FlutterwaveFacade;
use App\Models\Membership;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions()
    {
        $data['page_title'] = 'All Transasctions';
        return view('admin.report.transaction', $data);
    }

    // not done
    public function requery(Request $request, $tx_ref)
    {
        $result = FlutterwaveFacade::verifyTransaction($tx_ref);

        if ($result && $result->status == 'successful') {
            // $orders = json_decode($result->meta[2]->metavalue, true);
            // Order::insert($orders);
            $transaction = Transaction::where('tx_ref', $tx_ref)->firstOrFail();
            // update(['is_confirmed' => '1']);
            $transaction->is_confirmed = '1';

            $transaction->save();

            // Retrieve membership by user_id or instantiate with the reference and amount attributes...
            $membership = Membership::firstOrCreate(
                ['user_id' => $transaction->user_id],
                ['reference' => $tx_ref, 'amount' => $result->data->charged_amount,]
            );

            if ($membership) {
                // check if this user is referred
                $refer_info = Referral::where('referred_user_id', $transaction->user_id)->first();
                if ($refer_info) {
                    $bonus_percent = Setting::where('slug', 'referral_percentage')->first()->meta;
                    $bonus = $result->data->charged_amount * ($bonus_percent * 0.01);

                    $tax = Setting::where('slug', 'payout_tax_percentage')->first()->meta ?? '0.00';

                    $refer_info->bonus = $bonus * $tax;
                    $refer_info->tax = $tax;
                    $refer_info->amount = $bonus;
                    $refer_info->status = '1';
                    $refer_info->bonus_at = Carbon::now();
                    $refer_info->save();
                }

                return back()->with('success', 'payment successful, you have subscribed');
            }
            
            // send email
            $notification = [];

            // if (count($notification)) {
            //     Notification::insert($notification);
            // }
            if ($request->ajax()) {
                return response()->json(['success' => 'Transaction Verified Successfully!']);
            }
        }
        if ($request->ajax()) {
            return response()->json(['info' => 'Cannot verify Transaction!']);
        } else {
            $request->session()->flash('info', 'Cannot verify Transaction');
            return back();
        }
    }

    public function referrals()
    {
        $data['page_title'] = 'All Referral';
        return view('admin.report.referral', $data);
    }

    public function payouts()
    {
        $data['page_title'] = 'All Payouts';
        return view('admin.report.payout', $data);
    }

    public function videoLogs()
    {
        $data['page_title'] = 'All Video Logs';
        return view('admin.report.video-logs', $data);
    }

}
