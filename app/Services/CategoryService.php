<?php

namespace App\Services;

use App\Models\Category;
use Validator;

class CategoryService {

    public function index() {
        return $categories = Category::all();
    }

    public function store($input): Category | string
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        return $category = Category::create($input);
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
        $model->save();
        return $model;
    }

    public function destroy(Category $model): Category {
        $model->delete();
        return $model;
    }
}
