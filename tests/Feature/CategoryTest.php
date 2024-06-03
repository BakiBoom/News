<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Http\Controllers\API\CategoryController;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryTest extends TestCase
{
    protected $categoryController;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->categoryController = new CategoryController(new CategoryService());
    }

    public function test_store_method () {
        $request = Request::create('/dummy-url', 'POST', [
            'title' => 'new title category from test',
            'description' => 'new description category from test',
            'ispublish' => true,
            'publishdate' => '2024-06-03',
        ]);

        $response = $this->categoryController->store($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_index_method () {
        $response = $this->categoryController->index();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_update_method () {
        $category = new Category();

        $request = Request::create('/dummy-url', 'PUT', [
            'title' => 'new title category from test for update',
            'description' => 'new description category from test for update',
            'ispublish' => false,
            'publishdate' => '2024-06-03',
        ]);
        $response = $this->categoryController->update($request, $category);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_show_method () {
        $response = $this->categoryController->show(1);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
