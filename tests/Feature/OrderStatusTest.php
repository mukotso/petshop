<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class OrderStatusTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function validate_create_category_request(): void
    {
        $this->authenticateUser();
        $this->post(route('order-status.create'), [
        ])->assertStatus(422);
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_create_an_order_status(): void
    {
        $this->authenticateUser();
        $this->post(route('order-status.create'), [
            'title' => fake()->title
        ])->assertStatus(200)
            ->assertJsonStructure(
                [
                    'orderStatus',
                    'message'
                ]
            );
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_view_an_order_status(): void
    {
        $this->authenticateUser();
        $status = $this->post(route('order-status.create'), [
            'title' => fake()->title
        ]);

        $this->get(route('order-status.show', ['order_status_uuid' => $status['orderStatus']['id']]))
            ->assertStatus(200)->assertJsonStructure(
                [
                    'orderStatus',
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
        $status = $this->post(route('order-status.create'), [
            'title' => fake()->title
        ]);


        $this->put(
            route(
                'order-status.update',
                ['order_status_uuid' => $status['orderStatus']['id']]
            ),
            [
                'title' => fake()->title

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
    public function logged_in_user_can_delete_an_order_status(): void
    {
        $this->authenticateUser();
        $status = $this->post(route('order-status.create'), [
            'title' => fake()->title
        ]);

        $this->delete(
            route(
                'order-status.delete',
                ['order_status_uuid' => $status['orderStatus']['id']]
            )
        )->assertStatus(200)->assertJsonStructure(
            [
                'message'
            ]
        );
    }

}
