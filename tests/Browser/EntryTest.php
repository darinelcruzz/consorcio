<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EntryTest extends DuskTestCase
{
    //use DatabaseMigrations;

    public function test_an_entry_can_be_created()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('entries.create')
                    ->type('quotation', 5910)
                    ->keys('#date', 15)
                    ->keys('#date', 05)
                    ->keys('#date', 2017)
                    ->select('provider', '2')
                    ->type('amount', 1500)
                    ->type('items', 4)
                    ->press('Agregar')
                    ->assertPathIs('/entradas/crear');
        });
    }
}
