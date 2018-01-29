<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FreshSalesModuleTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    function lists_fresh_sales()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('fresh.index'))
            ->assertViewIs('sales.index')
            ->assertStatus(200);
    }

    /** @test */
    function creates_fresh_sale()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('fresh.create'))
            ->assertViewIs('sales.create')
            ->assertStatus(200);
    }
}
