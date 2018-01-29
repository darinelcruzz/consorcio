<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PorkSalesModuleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function lists_pork_sales()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('pork.index'))
            ->assertViewIs('sales.index')
            ->assertStatus(200);
    }

    /** @test */
    function creates_pork_sale()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('pork.create'))
            ->assertViewIs('sales.create')
            ->assertStatus(200);
    }
}
