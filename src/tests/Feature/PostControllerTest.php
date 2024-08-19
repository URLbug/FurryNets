<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    private function login(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
    }

    public function test_base(): void
    {
        $this->login();

        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function test_base_not_auth(): void
    {
        $response = $this->get('/posts');

        $response->assertStatus(302);
    }
    
    public function test_get_posts(): void
    {
        $this->login();

        $response = $this->get('/posts/1');

        $response->assertStatus(200);
    }

    public function test_get_ghost_posts(): void
    {
        $this->login();

        $response = $this->get('/posts/111');

        $response->assertStatus(404);
    }

    public function test_unlike_and_like_post(): void
    {
        $this->login();

        $response = $this->post('/posts/1');

        $response->assertStatus(302);

        $response = $this->post('/posts/1');

        $response->assertStatus(302);
    }

    public function test_unlike_and_like_ghost_post(): void
    {
        $this->login();
        
        $response = $this->post('/posts/111');

        $response->assertStatus(404);

        $response = $this->post('/posts/111');

        $response->assertStatus(404);
    }

    // public function test_unlike_and_like_null_post(): void
    // {
    //     $response = $this->post('/posts/0');

    //     $response->assertStatus(302);

    //     $response = $this->post('/posts/0');

    //     $response->assertStatus(302);
    // }
}
