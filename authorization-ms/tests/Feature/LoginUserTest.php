<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
   use  RefreshDatabase;

    /**
     * A user  can login with email and password .
     *
     * @return void
     */
    public function test_a_user_can_login_with_email_and_password()
    {
        $credentials = [
            "email" =>  "foulen@example.com",
            "password" =>  "password",
        ];
        $user =User::factory()->create(["email" => $credentials["email"]]);
         $user->setRole('employee');
        $response = $this->postJson('/api/authorization/login', $credentials);

        $response->assertOk();

        $response->assertJsonPath("message", __('auth.login_successful'));
    }
}
