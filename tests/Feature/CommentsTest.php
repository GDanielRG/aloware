<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_screen_can_be_rendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_root_comment_can_be_created()
    {
        $this->post(
            '/comments',
            [
                'user_name' => 'Sally',
                'comment' => 'Hello, world!'
            ]
        );

        $this->assertDatabaseHas('comments', [
            'user_name' => 'Sally',
            'content' => 'Hello, world!',
            'comment_id' => null,
        ]);
    }

    public function test_nested_comment_can_be_created()
    {
        $comment = Comment::factory()->create();

        $this->post(
            route('comments.comments.store', ['comment' => $comment->id]),
            [
                'user_name' => 'Nelly', 'comment' => 'Hello, world agin!'
            ]
        );

        $this->assertDatabaseHas('comments', [
            'user_name' => 'Nelly',
            'content' => 'Hello, world agin!',
            'comment_id' => $comment->id,
        ]);
    }

    public function test_nested_comment_is_maxed_at_third_level()
    {
        $comment = Comment::factory()
            ->for(
                Comment::factory()
                    ->for(Comment::factory()->create())
                    ->create()
            )
            ->create();

        $this->assertDatabaseCount('comments', 3);

        $this->post(
            route('comments.comments.store', ['comment' => $comment->id]),
            [
                'user_name' => 'Sally', 'comment' => 'Hello, world!'
            ]
        );

        $this->assertDatabaseCount('comments', 4);

        $this->assertDatabaseHas('comments', [
            'user_name' => 'Sally',
            'content' => 'Hello, world!',
            'comment_id' => $comment->comment->id,
        ]);
    }
}
