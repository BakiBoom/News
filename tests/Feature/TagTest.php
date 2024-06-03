<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;
use App\Http\Controllers\API\TagController;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagTest extends TestCase
{
    protected $tagController;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->tagController = new TagController(new TagService());
    }

    public function test_store_method () {
        $request = Request::create('/dummy-url', 'POST', [
            'title' => 'new title tag from test',
            'description' => 'new description tag from test',
            'ispublish' => true,
            'publishdate' => '2024-06-03',
        ]);
        $response = $this->tagController->store($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_index_method () {
        $response = $this->tagController->index();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_update_method () {
        $tag = new Tag();
        $request = Request::create('/dummy-url', 'PUT', [
            'title' => 'new title tag from test for update',
            'description' => 'new description tag from test for update',
            'ispublish' => false,
            'publishdate' => '2024-06-03',
        ]);
        $response = $this->tagController->update($request, $tag);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_show_method () {
        $response = $this->tagController->show(1);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
