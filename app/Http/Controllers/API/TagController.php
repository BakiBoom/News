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
        $input = $request->all();
        $result = $this->tagService->update($input, $tag);
        return $this->sendResponse($result->toArray(), 'Tag updated successfully.');
    }

    public function updateById(Request $request, $id)
    {
        $input = $request->all();
        $result = $this->tagService->updateById($input, $id);
        return $this->sendResponse($result->toArray(), 'Tag updated successfully.');
    }

    public function getTagsByCategoryId($categoryid) {
        $result = $this->tagService->getTagsByCategoryId($categoryid);
        return $this->sendResponse($result->toArray(), 'Tag successfully.');
    }

    public function moveBucket($id) {
        $result = $this->tagService->moveBucket($id);
        return $this->sendResponse($result->toArray(), 'Tag move bucket successfully.');
    }

    public function destroy($id)
    {
        $result = $this->tagService->destroy($id);
        return $this->sendResponse($result->toArray(), 'Tag deleted successfully.');
    }

    public function getFilterValues(Request $request){
        $input = $request->all();
        $result = $this->tagService->getFilterValues($request);
        return $this->sendResponse($result, 'Tag filter successfully.');
    }
}
