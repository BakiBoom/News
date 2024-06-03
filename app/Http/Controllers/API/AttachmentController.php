<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Attachment;
use Illuminate\Support\Facades\DB;
use App\Services\AttachmentService;
use Validator;

class AttachmentController extends BaseController
{
    protected $attachmentService;
    public function __construct(AttachmentService $attachmentService) {
        $this->middleware('auth:api')->except(['index', 'show', 'getByPostId']);
        $this->attachmentService = $attachmentService;
    }

    public function index()
    {
        return $this->sendResponse($this->attachmentService->index()->toArray(), 'Attachment retrieved successfully.');
    }

    public function store(Request $request)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $input = $request->all();
        $file = $request->file('attachmentfile');
        $result = $this->attachmentService->store($input, $file);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Attachment created successfully.');
    }

    public function show($id)
    {
        $result = $this->attachmentService->show($id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Attachment retrieved successfully.');
    }

    public function updateById(Request $request, $id)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $file = $request->file('attachmentfile');
        $result = $this->attachmentService->updateById($file, $id);
        if (is_string($result)) {
            return $this->sendError($result);
        }
        return $this->sendResponse($result->toArray(), 'Attachment updated successfully.');
    }

    public function destroy(Attachment $attachment)
    {
        if (!$this->middleware('auth:api')->passes()) {
            return $this->sendError('Unauthorized', [], 401);
        }
        
        $result = $this->attachmentService->destroy($attachment);
        return $this->sendResponse($result->toArray(), 'Attachment deleted successfully.');
    }

    public function getByPostId ($postId) {
        $result = $this->attachmentService->getByPostId($postId);
        return $this->sendResponse($result->toArray(), 'Attachment deleted successfully.');
    }
}
