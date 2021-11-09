<?php

namespace App\Console\Commands;

use App\Library\Facades\FlutterwaveFacade;
use App\Models\Payout;
use Illuminate\Console\Command;

class ProcessTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all eligible records for transfers';

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
            $result = FlutterwaveFacade::transfers($data);
            if (is_object($result)) {
                if (property_exists($result, 'id')) {
                    $data->update(['receipt_no' => $result->id]);
                    // Transfer::where('reference', $result->reference)->update(['receipt_no' => $result->id]);
                }
            }
        }
        
        return $this->info('All pending transfers');
        // return Command::SUCCESS;
    }
}
