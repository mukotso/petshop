<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class CategoryTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function validate_create_category_request(): void
    {
        $this->authenticateUser();
        $this->post(route('category.create'), [
        ])->assertStatus(422);
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_create_a_category(): void
    {
        $this->authenticateUser();
        $this->post(route('category.create'), [
            'title' => fake()->title,
            'slug' => fake()->name,
        ])->assertStatus(200)
            ->assertJsonStructure(
                [
                    'category',
                    'message'
                ]
            );
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_view_a_category(): void
    {
        $this->authenticateUser();
        $category = $this->post(route('category.create'), [
            'title' => fake()->title,
            'slug' => fake()->name,
        ]);

        $this->get(route('category.show', ['category_uuid' => $category ['category']['id']]))
            ->assertStatus(200)->assertJsonStructure(
                [
                    'category',
                    'message'
                ]
            );
    }


    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_update_a_category(): void
    {
        $this->authenticateUser();
        $category = $this->post(route('category.create'), [
            'title' => fake()->title,
            'slug' => fake()->name,
        ]);


        $this->put(
            route(
                'category.update',
                ['category_uuid' => $category['category']['id']]
            ),
            [
                'title' => fake()->title,
                'slug' => fake()->name,

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
    public function logged_in_user_can_delete_a_product(): void
    {
        $this->authenticateUser();
        $category = $this->post(route('category.create'), [
            'title' => fake()->title,
            'slug' => fake()->name,
        ]);

        $this->delete(
            route(
                'category.delete',
                ['category_uuid' => $category['category']['id']]
            )
        )->assertStatus(200)->assertJsonStructure(
            [
                'message'
            ]
        );
    }

}
