<?php

namespace App\Services;

use App\Models\PostFilter;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

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
        $title = array_key_exists('title', $input) == false ? null : $input['title'];
        $tagsid = array_key_exists('tagsid', $input) == false ? null : $input['tagsid'];
        $categorysid =  array_key_exists('categorysid', $input) == false ? null :  $input['categorysid'];
        $isdeleted = array_key_exists('isdeleted', $input) == false ? null : $input['isdeleted'];
        $startdate = array_key_exists('startdate', $input) == false ? null : $input['startdate'];
        $enddate = array_key_exists('enddate', $input) == false ? null : $input['enddate'];
        $filter = new PostFilter($title, $categorysid, $tagsid, $isdeleted, $startdate, $enddate);
        $posts = Post::whereNotNull('categoryid')
            ->where('categoryid', $filter->categorysid)
            ->whereNotNull('tagid')
            ->where('tagid', $filter->tagsid)
            ->whereNotNull('isdeleted')
            ->where('isdeleted', $filter->isdeleted)
            ->whereNotNull('publishdate')
            ->where('publishdate', '>', $filter->startdate)
            ->whereNotNull('publishdate')
            ->where('publishdate', '<', $filter->enddate)
            ->where(function($query) use ($filter) {
                $query->whereNull('title')
                    ->orWhere('title', 'LIKE', '%' . $filter->title . '%');
            })
            ->get();
        return $posts;
    }
}
