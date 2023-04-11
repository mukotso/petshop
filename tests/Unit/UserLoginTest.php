<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserLoginTest extends TestCase
{


    /** @test */
    public function admin_user_can_create_can_user()
    {
        $this->authenticateUser();

        $response = $this->post(route('user.create'), [
            "first_name" => "test",
            "last_name" => "john doe",
            "email" => "user@gmail.com",
            "password" => "password",
            "address" => "john njue",
            "phone_number" => "89767564546"
        ]);

        $response->assertStatus(200);

    }

    /** @test */
    public function user_cannot_log_in_with_incorrect_credentials()
    {
        //Create a login request with unknown user details.
        $response = $this->post(route('login'), ['email' => 'mukotso@gmail.com', 'password' => 'password']);

        $response
            //Check if response status is 404
            ->assertStatus(404);
    }

    /** @test */
    public function user_require_password_to_login(): void
    {
        $this->post(route('login'), [
                'email' => 'user@gmail.com'
            ]
        )->assertStatus(422);
    }

    /** @test */
    public function user_require_email_to_login(): void
    {
        $this->post(route('login'), [
                'password' => 'password'
            ]
        )->assertStatus(422);
    }
}
