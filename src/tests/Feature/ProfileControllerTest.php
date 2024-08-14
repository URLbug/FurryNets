<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    function auth_user(): void
    {
        Auth::attempt([
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
    }

    public function test_base(): void
    {
        $this->auth_user();

        $response = $this->get('/profile/admin');

        $response->assertStatus(200);

        auth()->logout();
    }

    public function test_not_exists_user(): void
    {
        $this->auth_user();

        $response = $this->get('/profile/test');

        $response->assertStatus(404);

        auth()->logout();
    }

    public function test_not_auth_user(): void
    {
        $response = $this->get('/profile/admin');

        $response->assertStatus(302);
    }
}
