<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CancelOrderWhenExpiredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel order when expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('expired_at', '<=', Carbon::now())->get();

        foreach ($orders as $order) {
            $order->status = Order::STATUS_CANCEL;
            $order->save();
        }

        $this->info('Successfully flushed ' . count($orders) . ' orders');
    }
}
