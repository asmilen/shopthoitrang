<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|max:255|unique:categories',
            'code' => 'required|alpha_num|unique:categories',
        ], [
            'name.max' => 'Tên danh mục quá dài, tối đa 255 ký tự.',
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'code.required' => 'Vui lòng nhập mã danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'code.unique' => 'Mã danh mục đã tồn tại.',
            'code.alpha_num' => 'Mã danh mục không được chứa kí tự đặc biệt.',
        ]);

        $category = Category::forceCreate([
            'name' => trim(request('name')),
            'code' => strtoupper(request('code')),
            'status' => !! request('status'),
        ]);

        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        $this->validate(request(), [
            'name' => 'required|max:255|unique:categories,name,'.$category->id,
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.max' => 'Tên danh mục quá dài, tối đa 255 kí tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
        ]);

        $category->forceFill([
            'name' => trim(request('name')),
            'status' => !! request('status'),
        ])->save();

        return $category;
    }

    public function listing()
    {
        $sorting = request('sorting', 'code');

        $direction = request('direction', 'asc');

        $page = request('page', 1);

        $limit = request('limit', 25);

        $builder = Category::where(function ($query) {
            if (! empty(request('q'))) {
                $query->where(function ($q) {
                    $q->where('id', 'like', '%'.request('q').'%')
                        ->orWhere('code', 'like', '%'.request('q').'%')
                        ->orWhere('name', 'like', '%'.request('q').'%');
                });
            }
        });

        $totalItems = $builder->count();

        $categories = $builder
            ->orderBy('status', 'desc')
            ->orderBy($sorting, $direction)
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        return response()->json([
            'data' => $categories,
            'total_items' => $totalItems,
        ]);
    }
}
