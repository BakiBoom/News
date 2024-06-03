<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Http\Controllers\API\CommentController;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentTest extends TestCase
{
    protected $commentController;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->commentController = new CommentController(new CommentService());
    }

    public function test_store_method () {
        $request = Request::create('/dummy-url', 'POST', [
            'title' => 'new title comment from test for example Nekrasov Sergey Igorevich (boom)',
            'description' => 'new description comment from test',
            'postid' => 1
        ]);
        $response = $this->commentController->store($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_index_method () {
        $response = $this->commentController->index();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_update_method () {
        $comment = new Comment();
        $request = Request::create('/dummy-url', 'PUT', [
            'title' => 'new title comment from test for example Nekrasov Sergey Igorevich (boom) for update',
            'description' => 'new description comment from test for update',
            'postid' => 1,
        ]);
        $response = $this->commentController->update($request, $comment);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_show_method () {
        $response = $this->commentController->show(1);

        $this->assertEquals(200, $response->getStatusCode());
    }
}

