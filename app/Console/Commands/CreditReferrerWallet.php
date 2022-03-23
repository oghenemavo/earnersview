<?php

namespace App\Console\Commands;

use App\Models\Referral;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreditReferrerWallet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit_referrer:wallet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Credit a Referrer Wallet with eligible bonus';

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
        $eligible_bonuses = Referral::where('bonus', '>', '0')->where('status', '1')->get();

        
        foreach($eligible_bonuses as $data) {
            $user_wallet = Wallet::where('user_id', $data->referrer_user_id)->first();
            if ($user_wallet) {
                $user_wallet->balance += $data->bonus;
                $user_wallet->save();
                $data->update(['status' => '2', 'credited_at' => Carbon::now()]);
            }
        }
        return $this->info('Found Wallets Credited with bonus');
    }
}
