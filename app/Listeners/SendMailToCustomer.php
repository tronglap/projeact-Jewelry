<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmailCustomer;

class SendMailToCustomer
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
    public function handle(object $event): void
    {
        $order = $event->order;

        Mail::to($order->user->email)->send(new OrderEmailCustomer($order));
    }
}