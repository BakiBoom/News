<?php

namespace App\Services;

use App\Models\CategoryFilter;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class CategoryService {

    public function index() {
        return $categories = Category::all();
    }

    public function store($input): Category | string
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
        return $category = Category::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'publishdate' => $input['publishdate'],
            'ispublish' => $input['ispublish'],
        ]);
    }

    public function show($id): Category | string  {
        $category = Category::find($id);
        if (is_null($category)) {
            return 'Category not found.';
        }
        return $category;
    }

    public function update($input, Category $model): Category | string  {
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->ispublish = $input['ispublish'];
        $model->ispublish = $input['isdeleted'];
        $model->save();
        return $model;
    }

    public function updateById ($input, $id): Category | string {
        $model = Category::find($id);
        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->ispublish = $input['ispublish'];
        $model->isdeleted = $input['isdeleted'];
        $model->save();
        return $model;
    }

    public function moveBucket($id): Category {
        $model = Category::find($id);
        $model->isdeleted = true;
        $model->save();
        return $model;
    }

    public function destroy($id): Category {
        $model = Category::find($id);
        $model->delete();
        return $model;
    }

    public function getFilterValues($input)
    {
        $filter = new CategoryFilter();
        $filter->tagsid = $input['tagsid'];
        $filter->isdeleted = $input['isdeleted'];
        $filter->created_at = $input['created_at'];
        $filter->deleted_at = $input['deleted_at'];
        return $filter;
    }
}
