<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use App\Http\Controllers\Controller;

class CategoryUnassignedAttributesController extends Controller
{
    public function index(Category $category)
    {
        return Attribute::whereNotIn(
                'id', $category->attributes()->pluck('id')
            )->orderBy('slug', 'asc')->get();
    }
}
