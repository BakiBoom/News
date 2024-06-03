<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentService {

    public function index() {
        return $commets = Comment::all();
    }

    public function store($input): Comment | string
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'postid' => 'required|integer'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        return $comment = Comment::create($input);
    }

    public function show($id): Comment | string  {
        $comment = Comment::find($id);
        if (is_null($comment)) {
            return 'Comment not found.';
        }
        return $comment;
    }

    public function update($input, Comment $model): Comment | string  {
        $validator = Validator::make($input, [
            'postid' => 'integer'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->tagid = $input['postid'];
        $model->save();
        return $model;
    }

    public function destroy(Comment $model): Comment {
        $model->delete();
        return $model;
    }
}
