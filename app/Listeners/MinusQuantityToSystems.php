<?php

namespace App\Listeners;

use App\Events\OrderSuccessEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MinusQuantityToSystems
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderSuccessEvent $event): void
    {
        $order = $event->order;
        foreach ($order->orderItems as $item) {
            $product = $item->product;
            $product->quantity -= $item->quantity;
            $product->save();
        }
    }
}