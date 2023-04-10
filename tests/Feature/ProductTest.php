<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_validate_create_product_request(): void
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
            'metadata'=>[
                "brand" => fake()->uuid,
                "image" => fake()->uuid,
            ]
        ])->assertStatus(200);
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_view_a_product(): void
    {
        $this->authenticateUser();
        $this->post(route('product.show',Product::query()->first()?->id))
        ->assertStatus(200);
    }


    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_update_a_product(): void
    {
        $this->authenticateUser();
        $this->put(route(
            'product.update',
            Product::query()->first()?->id
        ), [
            'title' => fake()->title,
            'price' => fake()->numberBetween(123.9, 890.34),
            'description' => fake()->sentence,
            'metadata'=>[
                "brand" => fake()->uuid,
                "image" => fake()->uuid,
            ]

        ])->assertStatus(200);
    }

    /**
     * @test
     * @throws Throwable
     */
    public function logged_in_user_can_delete_a_product(): void
    {
        $this->authenticateUser();
        $product_id = Product::query()->first()?->id;
       $response =  $this->put(route(
            'product.delete',
           $product_id
        ));

        $response->assertStatus(200)
       ->assertDatabaseMissing('products', [
           'id' => $product_id
       ]);

    }

}
