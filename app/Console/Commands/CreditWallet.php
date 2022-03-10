<?php

namespace App\Console\Commands;

use App\Models\VideoLog;
use App\Models\Wallet;
use Illuminate\Console\Command;

class CreditWallet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit:wallet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $logs = VideoLog::where('is_credited', '0')->get();

        foreach($logs as $log) {
            $user_wallet = Wallet::where('user_id', $log->user_id)->first();
            if ($user_wallet) {
                $user_wallet->balance += $log->credit;
                $user_wallet->save();
                $log->update(['is_credited' => '1']);
            }
        }
        return $this->info('Found Wallets Credited');
    }
}
