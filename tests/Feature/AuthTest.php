<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * Test case post has expected data in the Model fillable
     */
    public function check_user_not_logged_cant_see_data()
    {
        $response = $this->get('/api/books');

        $response->assertStatus(401);
    }

    /**
     * Test Integration
     * @test
     * Test case post has expected data in the Model fillable
     */
    public function check_user_logged_can_see_data()
    {
        $token = JWTAuth::fromUser(User::factory()->make());
        $response = $this->json(
                        'GET',
                            '/api/books',
                                [],
                                ['Authorization' => 'Bearer ' . $token]
                    )->assertStatus(200);
    }
}
