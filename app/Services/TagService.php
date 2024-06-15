<?php

namespace App\Services;

use App\Models\TagFilter;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class TagService {

    public function index() {
        return $tags = Tag::all();
    }

    public function store($input): Tag | string
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'publishdate' => 'required',
            'ispublish' => 'required'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        return $tag = Tag::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'publishdate' => $input['publishdate'],
            'ispublish' => $input['ispublish'],
            'categoryid' => $input['categoryid']
        ]);
    }

    public function show($id): Tag | string  {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return 'Tag not found.';
        }
        return $tag;
    }

    public function update($input, Tag $model): Tag | string  {
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->ispublish = $input['ispublish'];
        $model->save();
        return $model;
    }

    public function updateById ($input, $id): Tag | string {
        $model = Tag::find($id);
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->ispublish = $input['ispublish'];
        $model->isdeleted = $input['isdeleted'];
        $model->save();
        return $model;
    }

    public function getTagsByCategoryId($categoryid) {
        $tags = Tag::where('categoryid', $categoryid)->get();
        return $tags;
    }

    public function moveBucket($id): Tag {
        $model = Tag::find($id);
        $model->isdeleted = true;
        $model->save();
        return $model;
    }

    public function destroy($id): Tag {
        $model = Tag::find($id);
        $model->delete();
        return $model;
    }

    public function getFilterValues($input){
        $filter = new TagFilter();
        $filter->isdeleted = $input['isdeleted'];
        $filter->created_at = $input['created_at'];
        $filter->deleted_at = $input['deleted_at'];
        return $filter;
    }
}
