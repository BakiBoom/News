<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Comment;
use App\Services\CommentService;
use Validator;

class CommentController extends BaseController
{
    protected $commentService;
    public function __construct(CommentService $commentService) {
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->commentService = $commentService;
    }
    public function index()
    {
        $result = $this->commentService->index();
        return $this->sendResponse($result->toArray(), 'Comments retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $result = $this->commentService->store($input);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Comment created successfully.');
    }

    public function show($id)
    {
        $result = $this->commentService->show($id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Comment retrieved successfully.');
   }

    public function update(Request $request, Comment $comment)
    {
        $input = $request->all();
        $result = $this->commentService->update($input, $comment);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $result = $this->commentService->destroy($comment);
        return $this->sendResponse($result->toArray(), 'Comment deleted successfully.');
    }
}
