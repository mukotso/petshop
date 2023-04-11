<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Throwable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    public User|null $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * @throws Throwable
     */
    public function authenticateAdmin(): void
    {
        /** @var Authenticatable $user */
        $user = $this->user = User::query()
            ->where('is_admin', true)
            ->first();
        $this->actingAs($user);
    }

    /**
     * @throws Throwable
     */
    public function authenticateUser(): void
    {
        /** @var Authenticatable $user */
        $user = $this->user = User::query()->first();
        $this->actingAs($user);
    }
}
