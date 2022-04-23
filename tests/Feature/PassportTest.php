<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\ClientRepository;

class PassportTest extends TestCase
{
  /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;
 
    protected $headers = [];
    protected $scopes = [];
    protected $user;
    
    public function setUp() : void
    {    
         parent::setUp();
         $clientRepository = new ClientRepository();
         $client = $clientRepository->createPersonalAccessClient(
          null, 'Test Personal Access Client', ''
         );

         DB::table('oauth_personal_access_clients')->insert([
          'client_id' => $client->id,
          'created_at' => new \DateTime,
          'updated_at' => new \DateTime,
         ]);

         $this->user = User::factory()->create();
         $token = $this->user->createToken('TestToken', $this->scopes)->accessToken;
         $this->headers['Accept'] = 'application/json';
         $this->headers['Authorization'] = 'Bearer '.$token;
    }
}
