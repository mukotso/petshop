<?php

namespace Tests\Feature;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function user_can_login_in_with_correct_credentials()
    {

        //Create a login request with known user details.
        $response = $this->postJson('/api/v1/user/login', ['email' => 'user@gmail.com', 'password' => 'password']);

        $response
            //Check if response status is 200
            ->assertStatus(200)
            //Check if response has data->token
            ->assertJsonStructure(['data' => ['token']])
            //Check if response is success
            ->assertJson(
                [
                    'success' => true
                ]
            );
    }

    public function user_cannot_log_in_with_incorrect_credentials()
    {

        //Create a login request with unknown user details.
        $response = $this->post(route('login'), ['email' => 'mukotso@gmail.com', 'password' => 'password']);

        $response
            //Check if response status is 400
            ->assertStatus(400);
    }

    public function user_require_password_to_login(): void
    {
        $this->post(route('login'), [
                'email' => 'user@gmail.com'
            ]
        )->assertStatus(422);
    }


    public function user_require_email_to_login(): void
    {
        $this->post(route('login'), [
                'password' => 'password'
            ]
        )->assertStatus(422);
    }
}
