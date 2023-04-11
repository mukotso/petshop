<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class PaymentTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function validate_create_payment_request(): void
    {
        $this->authenticateUser();
        $this->post(route('payment.create'), [
        ])->assertStatus(422);
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_create_a_payment(): void
    {
        $this->authenticateUser();
        $this->post(route('payment.create'), [
            "type" => fake()->name,
            "details" => [
                "address" => fake()->address,
                "last_name" => fake()->firstName,
                "first_name" => fake()->lastName
            ]
        ])->assertStatus(200)
            ->assertJsonStructure(
                [
                    'payment',
                    'message'
                ]
            );
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_view_a_payment(): void
    {
        $this->authenticateUser();
        $payment = $this->post(route('payment.create'), [
            "type" => fake()->name,
            "details" => [
                "address" => fake()->address,
                "last_name" => fake()->firstName,
                "first_name" => fake()->lastName
            ]
        ]);

        $this->get(route('payment.show', ['payment_uuid' => $payment['payment']['id']]))
            ->assertStatus(200)->assertJsonStructure(
                [
                    'payment',
                    'message'
                ]
            );
    }


    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_update_an_order_status(): void
    {
        $this->authenticateUser();
        $payment = $this->post(route('payment.create'), [
            "type" => fake()->name,
            "details" => [
                "address" => fake()->address,
                "last_name" => fake()->firstName,
                "first_name" => fake()->lastName
            ]
        ]);


        $this->put(
            route(
                'payment.update',
                ['payment_uuid' => $payment['payment']['id']]
            ),
            [
                "type" => fake()->name,
                "details" => [
                    "address" => fake()->address,
                    "last_name" => fake()->firstName,
                    "first_name" => fake()->lastName
                ]

            ]
        )->assertStatus(200)->assertJsonStructure(
            [
                'message'
            ]
        );
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_delete_a_payment(): void
    {
        $this->authenticateUser();
        $payment = $this->post(route('payment.create'), [
            "type" => fake()->name,
            "details" => [
                "address" => fake()->address,
                "last_name" => fake()->firstName,
                "first_name" => fake()->lastName
            ]
        ]);

        $this->delete(
            route(
                'payment.delete',
                ['payment_uuid' => $payment['payment']['id']]
            )
        )->assertStatus(200)->assertJsonStructure(
            [
                'message'
            ]
        );
    }

}
