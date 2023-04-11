<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class ProductTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function can_validate_create_product_request(): void
    {
        $this->authenticateUser();
        $this->post(route('product.create'), [
        ])->assertStatus(422);
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_create_a_product(): void
    {
        $this->authenticateUser();
        $this->post(route('product.create'), [
            'category_id' => Category::query()->first()?->id,
            'title' => fake()->title,
            'price' => fake()->numberBetween(50, 100),
            'description' => fake()->sentence,
            'metadata' => [
                "brand" => fake()->uuid,
                "image" => fake()->uuid,
            ]
        ])->assertStatus(200)
            ->assertJsonStructure(
                [
                    'product',
                    'message'
                ]
            );
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_view_a_product(): void
    {
        $this->authenticateUser();
        $product = $this->post(route('product.create'), [
            'category_id' => Category::query()->first()?->id,
            'title' => fake()->title,
            'price' => fake()->numberBetween(50, 100),
            'description' => fake()->sentence,
            'metadata' => [
                "brand" => fake()->uuid,
                "image" => fake()->uuid,
            ]
        ]);

        $this->get(route('product.show', ['product_uuid' => $product['product']['id']]))
            ->assertStatus(200) ->assertJsonStructure(
                [
                    'product',
                    'message'
                ]
            );
    }


    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_update_a_product(): void
    {
        $this->authenticateUser();
        $product = $this->post(route('product.create'), [
            'category_id' => Category::query()->first()?->id,
            'title' => fake()->title,
            'price' => fake()->numberBetween(50, 100),
            'description' => fake()->sentence,
            'metadata' => [
                "brand" => fake()->uuid,
                "image" => fake()->uuid,
            ]
        ]);


        $this->put(
            route(
                'product.update',
                ['product_uuid' => $product['product']['id']]
            ),
            [
                'category_id' => Category::query()->first()?->id,
                'title' => fake()->title,
                'price' => fake()->numberBetween(80, 1000),
                'description' => fake()->sentence,
                'metadata' => [
                    "brand" => fake()->uuid,
                    "image" => fake()->uuid,
                ]

            ]
        )->assertStatus(200) ->assertJsonStructure(
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
        $product = $this->post(route('product.create'), [
            'category_id' => Category::query()->first()?->id,
            'title' => fake()->title,
            'price' => fake()->numberBetween(50, 100),
            'description' => fake()->sentence,
            'metadata' => [
                "brand" => fake()->uuid,
                "image" => fake()->uuid,
            ]
        ]);

        $this->delete(
            route(
                'product.delete',
                ['product_uuid' => $product['product']['id']]
            )
        )->assertStatus(200) ->assertJsonStructure(
            [
                'message'
            ]
        );
    }

}
