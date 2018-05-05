<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use App\Http\Controllers\Controller;

class CategoryAttributesController extends Controller
{
    public function store(Category $category, Attribute $attribute)
    {
        $category->attributes()->attach($attribute);
    }

    public function destroy(Category $category, Attribute $attribute)
    {
        $category->attributes()->detach($attribute);
    }
}
