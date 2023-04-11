<?php

namespace Tests\Unit;


use Tests\TestCase;

class AdminLoginTest extends TestCase
{

    /** @test */
    public function admin_user_cannot_log_in_with_incorrect_credentials()
    {

        //Create a login request with unknown user details.
        $response = $this->post(route('login'), ['email' => 'admin@gmail.com', 'password' => 'password']);

        $response
            //Check if response status is 400
            ->assertStatus(404);
    }

    public function admin_user_require_password_to_login(): void
    {
        $this->post(route('login'), [
            'email' => 'admin@gmail.com'
            ]
        )->assertStatus(422);
    }


    public function admin_user_require_email_to_login(): void
    {
        $this->post(route('login'), [
                'password' => 'password'
            ]
        )->assertStatus(422);
    }
}
