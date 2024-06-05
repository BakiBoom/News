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
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->postService = $postService;
    }
    public function index()
    {
        $result = $this->postService->index();
        return $this->sendResponse($result->toArray(), 'Posts retrieved successfully.');
    }

    public function store(Request $request)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

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
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $input = $request->all();
        $result = $this->postService->update($input, $post);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Post updated successfully.');
    }

    public function updateById(Request $request, $id)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $input = $request->all();
        $result = $this->postService->updateById($input, $id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Post updated successfully.');
    }

    public function moveBucket($id) {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $result = $this->postService->moveBucket($id);
        return $this->sendResponse($result->toArray(), 'Post move bucket successfully.');
    }

    public function destroy(Post $post)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }
        
        $result = $this->postService->destroy($post);
        return $this->sendResponse($result->toArray(), 'Post deleted successfully.');
    }
}
