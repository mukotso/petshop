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
        $this->app->bind('App\Interfaces\BrandInterface', 'App\Repositories\BrandRepository');
        $this->app->bind('App\Interfaces\CategoryInterface', 'App\Repositories\CategoryRepository');
        $this->app->bind('App\Interfaces\FileInterface', 'App\Repositories\Fileepository');
        $this->app->bind('App\Interfaces\OrderInterface', 'App\Repositories\OrderRepository');
        $this->app->bind('App\Interfaces\OrderStatusInterface', 'App\Repositories\OrderStatusRepository');
        $this->app->bind('App\Interfaces\PaymentInterface', 'App\Repositories\PaymentRepository');
        $this->app->bind('App\Interfaces\PostInterface', 'App\Repositories\PostRepository');
        $this->app->bind('App\Interfaces\ProductInterface', 'App\Repositories\ProductRepository');
        $this->app->bind('App\Interfaces\PromotionInterface', 'App\Repositories\PromotionRepository');
        $this->app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
