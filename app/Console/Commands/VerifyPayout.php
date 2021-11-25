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

        foreach ($payouts as $data) {
            $response = FlutterwaveFacade::getTransfer($data->receipt_no);
// var_dump($response);
            if (strtolower($response->status) == 'success') {
                if (strtolower($response->data->status) == 'successful') {
                    $data->update(['status' => 'successful', 'is_notified' => '1']);

                    $payout_data = [
                        'account' => $data->user->account_number,
                        'bank' => $data->user->bank_account,
                        'amount' => $data->amount,
                    ];

                    // $html = view('email.payout', $payout_data)->render();
                    // $notification[] = [
                    //     'email' => $data->user->email,
                    //     'name' => $data->user->lastname . ' ' . $data->user->firstname,
                    //     'subject' => 'Payout Made',
                    //     'body' => $html,
                    //     'created_at' => Carbon::now(),
                    //     'updated_at' => Carbon::now(),
                    // ];
                } elseif (strtolower($response->data->status) == 'failed') {
                    $data->update(['status' => 'failed']);
                    $user_wallet = Wallet::where('user_id', $data->user_id)->first();
                    if ($user_wallet) {
                        $user_wallet->ledeger_balance -= $data->amount;
                        $user_wallet->balance += $data->amount;
                    }
                }
            }
        }
        return $this->info('All transfers status verified');
        // return Command::SUCCESS;
    }
}
