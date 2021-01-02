<?php

namespace App\Observers;

use App\Shipping;

class TestObserver
{
    /**
     * Handle the shipping "created" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function created(Shipping $shipping)
    {
        //
    }

    /**
     * Handle the shipping "updated" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function updated(Shipping $shipping)
    {
        //
    }

    /**
     * Handle the shipping "deleted" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function deleted(Shipping $shipping)
    {
        //
    }

    /**
     * Handle the shipping "restored" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function restored(Shipping $shipping)
    {
        //
    }

    /**
     * Handle the shipping "force deleted" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function forceDeleted(Shipping $shipping)
    {
        //
    }
}
