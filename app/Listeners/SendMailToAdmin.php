<?php

namespace App\Listeners;

use App\Mail\OrderEmailAdmin;
use Illuminate\Support\Facades\Mail;

class SendMailToAdmin
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

        Mail::to('tronglap0@gmail.com')->send(new OrderEmailAdmin($order));
    }
}