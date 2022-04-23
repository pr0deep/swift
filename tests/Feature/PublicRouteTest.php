<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_public_route()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        
        $response = $this->get('/api');
        $response->assertStatus(200);
    }
}
