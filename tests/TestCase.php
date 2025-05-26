<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Modules\Auth\Models\User;
use App\Http\Middleware\VerifyCsrfToken;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
    }

    protected function loginAsUser($attributes = [])
    {
        $user = User::factory()->create($attributes);
        $this->actingAs($user);
        return $user;
    }
}
