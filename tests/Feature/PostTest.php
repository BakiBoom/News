<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Http\Controllers\API\PostController;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostTest extends TestCase
{
    protected $postController;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->postController = new PostController(new PostService());
    }

    public function test_store_method () {
        $request = Request::create('/dummy-url', 'POST', [
            'title' => 'new title post from test',
            'description' => 'new description post from test',
            'tagid' => 1,
            'categoryid' => 1,
            'ispublish' => true,
            'publishdate' => '2024-06-03',
        ]);
        $response = $this->postController->store($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_index_method () {
        $response = $this->postController->index();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_update_method () {
        $post = new Post();
        $request = Request::create('/dummy-url', 'PUT', [
            'title' => 'new title post from test for update',
            'description' => 'new description post from test for update',
            'tagid' => 1,
            'categoryid' => 1,
            'ispublish' => true,
            'publishdate' => '2024-06-03',
        ]);
        $response = $this->postController->update($request, $post);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_show_method () {
        $response = $this->postController->show(1);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
