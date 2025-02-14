<?php

namespace App\Observers;


use App\Models\Order;
use Illuminate\Support\Str;

class OrderObserver
{
    /**
     * @param Order $order
     * @return void
     */
    public function creating(Order $order): void
    {
        $order->order_id = Str::uuid();
    }
}
