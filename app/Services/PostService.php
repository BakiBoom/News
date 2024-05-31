<?php

namespace App\Services;

use App\Models\Post;
use Validator;

class PostService {

    public function index() {
        return $posts = Post::all();
    }

    public function store($input): Post | string
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'categoryid' => 'required',
            'tagid' => 'required'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        return $post = Post::create($input);
    }

    public function show($id): Post | string  {
        $post = Post::find($id);
        if (is_null($post)) {
            return 'Post not found.';
        }
        return $post;
    }

    public function update($input, Post $model): Post | string  {
        $validator = Validator::make($input, [
            'categoryid' => 'integer',
            'tagid' => 'integer'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->categoryid = $input['categoryid'];
        $model->tagid = $input['tagid'];
        $model->save();
        return $model;
    }

    public function destroy(Post $model): Post {
        $model->delete();
        return $model;
    }
}
