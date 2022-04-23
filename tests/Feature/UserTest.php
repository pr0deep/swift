<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Laravel\Passport\ClientRepository;

class UserTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user_db()
    {
        // create a user and test if everything works as expected ..
        $user = User::factory()->create();
        $this->assertDatabaseCount('users', 1);
        $this->assertModelExists($user);

        $user->delete();
        $this->assertModelMissing($user);
    }
    public function test_api_user_register(){
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
         null, 'Test Personal Access Client', ''
        );
        $user = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'password_confirmation' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'phone' => Str::random(10),
            'remember_token' => Str::random(10),
        ];
       // echo '<pre>'; print_r($user); echo '</pre>';
        $this->post('/api/register', $user)->assertStatus(200);
    }
}
