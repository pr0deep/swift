<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use tests\Feature\PassportTest;
use Laravel\Passport\Passport;


class ProtectedRoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_user_info()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );
        $response = $this->get('/api/user');
        $response->assertStatus(200);
    }
    public function test_api_logout()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );
        $response = $this->post('/api/logout');
        $response->assertStatus(200);

    }
}
