<?php

namespace App\Console\Commands;

use App\Library\Facades\FlutterwaveFacade;
use App\Models\Payout;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VerifyPayout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:payout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify Transfer Status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payouts = Payout::where('status', 'pending')->where('attempts', '<', '4')->get();
        
        // 1. Get Data
        foreach ($payouts as $data) {
            // 2. check that the data exists on flutterwave
            $payout = FlutterwaveFacade::check_transfer($data->receipt_no);

            // 3. process if it exist
            if (strtolower($payout->status) == 'success' && $payout->data) {
                $payout_data = $payout->data;
                
                if (strtolower($payout_data->status) == 'successful') {
                    $data->update([
                        'status' => 'successful', 
                        'is_notified' => '1', 
                        'message' => $payout_data->complete_message
                    ]);
                } else { // failed // pending // etc
                    $data->update([
                        'status' => strtolower($payout_data->status),
                        'message' => $payout_data->complete_message
                    ]);
                }
    
                // $payout_data = [
                //     'account' => $data->user->account_number,
                //     'bank' => $data->user->bank_account,
                //     'amount' => $data->amount,
                // ];

                // $html = view('email.payout', $payout_data)->render();
                // $notification[] = [
                //     'email' => $data->user->email,
                //     'name' => $data->user->lastname . ' ' . $data->user->firstname,
                //     'subject' => 'Payout Made',
                //     'body' => $html,
                //     'created_at' => Carbon::now(),
                //     'updated_at' => Carbon::now(),
                // ];
            } else { // 4. process if it doesn't exist
                $user_wallet = Wallet::where('user_id', $data->user_id)->first();
                if ($user_wallet) {
                    $data->update(['status' => 'failed', 'message' => 'FAILED']);
                    $user_wallet->ledger_balance -= $data->amount;
                    $user_wallet->balance += $data->amount;
                    $user_wallet->save();
                }
            }
        }
        return $this->info('All transfers status verified');
    }
}
