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
        $orders = Order::->whereNotNull('expired_at')
                        ->where('expired_at', '<=', Carbon::now())
                        ->get();

        foreach ($orders as $order) {
            if ($order->status == Order::STATUS_PENDING) {
                foreach ($order->products as $orderProduct) {
                    $product = $orderProduct->product;
                    $product->in_stock = 1;
                    $product->save();
                }
                $order->status = Order::STATUS_CANCELLED;
            } else {
                $order->expired_at = null;
            }

            $order->save();
        }

        $this->info('Successfully flushed ' . count($orders) . ' orders');
    }
}
