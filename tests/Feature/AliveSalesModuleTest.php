<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AliveSalesModuleTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    function lists_alive_sales()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('alive.index'))
            ->assertViewIs('sales.index')
            ->assertStatus(200);
    }

    /** @test */
    function creates_alive_sale()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('alive.create'))
            ->assertViewIs('sales.create')
            ->assertStatus(200);
    }
}
