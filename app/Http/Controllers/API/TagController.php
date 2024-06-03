<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Tag;
use App\Services\TagService;
use Validator;

class TagController extends BaseController
{
    protected $tagService;
    public function __construct(TagService $tagService) {
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->tagService = $tagService;
    }
    public function index()
    {
        $result = $this->tagService->index();
        return $this->sendResponse($result->toArray(), 'Tags retrieved successfully.');
    }

    public function store(Request $request)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $input = $request->all();
        $result = $this->tagService->store($input);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Tag created successfully.');
    }

    public function show($id)
    {
        $result = $this->tagService->show($id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Tag retrieved successfully.');
    }

    public function update(Request $request, Tag $tag)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }
        
        $input = $request->all();
        $result = $this->tagService->update($input, $tag);
        return $this->sendResponse($result->toArray(), 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $result = $this->tagService->destroy($tag);
        return $this->sendResponse($result->toArray(), 'Tag deleted successfully.');
    }
}
