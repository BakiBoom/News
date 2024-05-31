<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use App\Services\PostService;
use Validator;

class PostController extends BaseController
{
    protected $postService;
    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }
    public function index()
    {
        $result = $this->postService->index();
        return $this->sendResponse($result->toArray(), 'Posts retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $result = $this->postService->store($input);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Post created successfully.');
    }

    public function show($id)
    {
        $result = $this->postService->show($id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Post retrieved successfully.');
    }

    public function update(Request $request, Post $post)
    {
        $input = $request->all();
        $result = $this->postService->update($input, $comment);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $result = $this->postService->destroy($post);
        return $this->sendResponse($result->toArray(), 'Post deleted successfully.');
    }
}
