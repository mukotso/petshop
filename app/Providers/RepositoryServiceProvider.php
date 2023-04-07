<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Interfaces\V1\BrandInterface', 'App\Repositories\V1\BrandRepository');
        $this->app->bind('App\Interfaces\V1\CategoryInterface', 'App\Repositories\V1\CategoryRepository');
        $this->app->bind('App\Interfaces\V1\FileInterface', 'App\Repositories\Fileepository');
        $this->app->bind('App\Interfaces\V1\OrderInterface', 'App\Repositories\V1\OrderRepository');
        $this->app->bind('App\Interfaces\V1\OrderStatusInterface', 'App\Repositories\V1\OrderStatusRepository');
        $this->app->bind('App\Interfaces\V1\PaymentInterface', 'App\Repositories\V1\PaymentRepository');
        $this->app->bind('App\Interfaces\V1\PostInterface', 'App\Repositories\V1\PostRepository');
        $this->app->bind('App\Interfaces\V1\ProductInterface', 'App\Repositories\V1\ProductRepository');
        $this->app->bind('App\Interfaces\V1\PromotionInterface', 'App\Repositories\V1\PromotionRepository');
        $this->app->bind('App\Interfaces\V1\UserInterface', 'App\Repositories\V1\UserRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
