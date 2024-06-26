<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use App\Services\CategoryService;
use Validator;

class CategoryController extends BaseController
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService) {
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $result = $this->categoryService->index();
        return $this->sendResponse($result->toArray(), 'Categories retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $result = $this->categoryService->store($input);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Category created successfully.');
    }

    public function show($id)
    {
        $result = $this->categoryService->show($id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Category retrieved successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $result = $this->categoryService->update($input, $category);
        return $this->sendResponse($result->toArray(), 'Category updated successfully.');
    }

    public function updateById(Request $request, $id)
    {
        $input = $request->all();
        $result = $this->categoryService->updateById($input, $id);
        return $this->sendResponse($result->toArray(), 'Category updated successfully.');
    }

    public function moveBucket($id) {
        $result = $this->categoryService->moveBucket($id);
        return $this->sendResponse($result->toArray(), 'Category move bucket successfully.');
    }

    public function destroy($id)
    {
        $result = $this->categoryService->destroy($id);
        return $this->sendResponse($result->toArray(), 'Category deleted successfully.');
    }

    public function getFilterValues(Request $request){
        $input = $request->all();
        $result = $this->categoryService->getFilterValues($request);
        return $this->sendResponse($result, 'Category filter successfully.');
    }
}
