<?php

namespace App\Services;

use App\Models\Tag;
use Validator;

class TagService {

    public function index() {
        return $tags = Tag::all();
    }

    public function store($input): Tag | string
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        return $tag = Tag::create($input);
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
        $model->save();
        return $model;
    }

    public function destroy(Tag $model): Tag {
        $model->delete();
        return $model;
    }
}
