<?php

namespace App\Services;

use App\Models\PostFilter;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PostService {

    public function index(TagFilter $request) {
        $posts = Post::filter($request);
        if (isset($posts)){
            return $posts;
        } else {
            return $post = Post::all();
        }
    }

    public function store($input): Post | string
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'categoryid' => 'required',
            'tagid' => 'required',
            'publishdate' => 'required',
            'ispublish' => 'required'

        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        return $post = Post::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'categoryid' => $input['categoryid'],
            'tagid' => $input['tagid'],
            'publishdate' => $input['publishdate'],
            'ispublish' => $input['ispublish'],
        ]);
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
        $model->ispublish = $input['ispublish'];
        $model->isdeleted = $input['isdeleted'];
        $model->save();
        return $model;
    }

    public function updateById ($input, $id): Post | string {
        $validator = Validator::make($input, [
            'categoryid' => 'integer',
            'tagid' => 'integer'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        $model = Post::find($id);
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->categoryid = $input['categoryid'];
        $model->tagid = $input['tagid'];
        $model->ispublish = $input['ispublish'];
        $model->isdeleted = $input['isdeleted'];
        $model->publishdate = $input['publishdate'];
        $model->save();
        return $model;
    }

    public function moveBucket($id): Post {
        $model = Post::find($id);
        $model->isdeleted = true;
        $model->save();
        return $model;
    }

    public function destroy($id): Post {
        $model = Post::find($id);
        $model->delete();
        return $model;
    }

    public function getFilterValues($input){
        $filter = new PostFilter();
        $filter->title = $input['title'];
        $filter->categorysid = $input['categorysid'];
        $filter->tagsid = $input['tagsid'];
        $filter->isdeleted = $input['isdeleted'];
        $filter->created_at = $input['created_at'];
        $filter->deleted_at = $input['deleted_at'];
        return $filter;
    }
}
