<?php

namespace App\Console\Commands;

use App\Models\Payout;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessPayout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:payout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all eligible wallet balance records for transfers';

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
        $user_wallet = Wallet::where('balance', '>', '99')->get();

        if ($user_wallet->count() > 0) {
            $max = $user_wallet->count();
            $insert = [];
            
            for ($i=0; $i < $max; $i++) { 
                $wallet_data = $user_wallet[$i];
                $insert[] = [
                    'user_id' => $wallet_data->user_id,
                    // 'reason' => 'Payout',
                    'amount' => $wallet_data->balance,
                    'reference' => bin2hex(openssl_random_pseudo_bytes(10)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $fetched_wallet = Wallet::where('user_id', $wallet_data->user_id)->first();
                // sub amount from wallet to ledger
                $fetched_wallet->balance -= $wallet_data->balance;
                $fetched_wallet->ledger_balance += $wallet_data->balance;
                $fetched_wallet->save();
            }
            // insert transfer record
            Payout::insert($insert);
            return $this->info('Eligible Wallet balances have been processed for transfers');
        }

        
        return $this->info('No eligible Wallet record found for transfers');
        // return Command::SUCCESS;
    }
}
