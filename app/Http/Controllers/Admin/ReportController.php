<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Facades\FlutterwaveFacade;
use App\Models\Membership;
use App\Models\Transaction;
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
            $transaction = Transaction::where('tx_ref', $tx_ref)->firstOrFail();update(['is_confirmed' => '1']);
            $transaction->is_confirmed = '1';

            $transaction->save();

            // Retrieve membership by user_id or instantiate with the reference and amount attributes...
            $membership = Membership::firstOrCreate(
                ['user_id' => $transaction->user_id],
                ['reference' => $tx_ref, 'amount' => $result->data->charged_amount,]
            );
            
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

}
