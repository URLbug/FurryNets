<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    private function login(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
    }

    public function test_add_comment(): void
    {
        $this->login();

        $response = $this->post('/comment', [
            'text' => 'test',
            'post' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_add_comment_null(): void
    {
        $this->login();

        $response = $this->post('/comment', [
            'text' => 'test',
            'post' => 0,
        ]);

        $response->assertStatus(302);
    }

    public function test_add_comment_char(): void
    {
        $this->login();

        $response = $this->post('/comment', [
            'text' => '😀😀😀😀',
            'post' => 1,
        ]);

        $response->assertStatus(302);

        $response = $this->post('/comment', [
            'text' => 'test',
            'post' => '😀',
        ]);

        $response->assertStatus(302);
    }

    public function test_add_comment_empty(): void
    {
        $this->login();

        $response = $this->post('/comment', [
            'text' => '',
            'post' => '',
        ]);

        $response->assertStatus(302);

        $response = $this->post('/comment', [
            'text' => null,
            'post' => null,
        ]);

        $response->assertStatus(302);
    }

    public function test_add_comment_not_text(): void
    {
        $this->login();

        $response = $this->post('/comment', [
            'text' => '',
            'post' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_like_comment(): void
    {
        $this->login();

        $response = $this->post('/comment/1');

        $response->assertStatus(302);
    }

    public function test_unlike_comment(): void
    {
        $this->login();

        $response = $this->post('/comment/1');

        $response->assertStatus(302);
    }

    public function test_like_and_unlike_comment_null(): void
    {
        $this->login();

        $response = $this->post('/comment/0');

        $response->assertStatus(302);

        $response = $this->post('/comment/0');

        $response->assertStatus(302);
    }
}
