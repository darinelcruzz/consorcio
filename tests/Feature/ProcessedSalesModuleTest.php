<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProcessedSalesModuleTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    function lists_processed_sales()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('processed.index'))
            ->assertViewIs('sales.index')
            ->assertStatus(200);
    }

    /** @test */
    function creates_processed_sale()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->get(route('processed.create'))
            ->assertViewIs('sales.create')
            ->assertStatus(200);
    }
}
