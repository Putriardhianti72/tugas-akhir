<?php

namespace App\Console\Commands;

use App\Models\RetailOrder;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CancelRetailOrderWhenExpiredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retail-order:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel retail order when expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = RetailOrder::whereNotNull('expired_at')
                        ->where('expired_at', '<=', Carbon::now())
                        ->update([
                            'status' => RetailOrder::STATUS_CANCELLED,
                        ]);

        $this->info('Successfully flushed ' . count($orders) . ' orders');
    }
}
