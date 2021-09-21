<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_available_order_form()
    {
        $response = $this->get('/order/' );

        $response->assertStatus(200);
    }

    public function test_another_available_order_form()
    {
        $response = $this->get('/order/' );
        $response->assertOk();
    }
}
