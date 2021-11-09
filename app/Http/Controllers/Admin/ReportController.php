<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Facades\FlutterwaveFacade;
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
            $orders = json_decode($result->meta[2]->metavalue, true);
            // Order::insert($orders);
            Transaction::where('tx_ref', $tx_ref)->update(['is_confirmed' => '1']);
            

            // send email
            $notification = [];
            $dbOrders = Order::where('transaction_id', $orders[0]['transaction_id'])->get();
            foreach ($dbOrders as $order) {
                $data['order'] = $order;
                
                $html = view('email.ticket-receipt', $data)->render();
                $notification[] = [
                    'email' => $order->email,
                    'name' => $order->lastname . ' ' . $order->firstname,
                    'subject' => 'Ticket ' . $order->event->title,
                    'body' => $html,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            if (count($notification)) {
                Notification::insert($notification);
            }
            if ($request->ajax()) {
                return response()->json(['success' => 'Transaction Verified Successfully!']);
            } else {
                $request->session()->flash('paid', 'Ticket Purchased successfully');
                return back();
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
