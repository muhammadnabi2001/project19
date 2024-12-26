<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        $category=PostCategory::all();
        $data=[
            'postcategories'=>$category,
            'message'=>'success'
        ];
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255'
        ]);
        $model=PostCategory::create($request->all());
        $data=[
            'model'=>$model,
            'message'=>'success'
        ];
        return response()->json($data);
    }
    public function update(PostCategory $category,Request $request)
    {
        $request->validate([
            'name'=>'required|max:255'
        ]);
        $category->update($request->all());
        $data=[
            'model'=>$category,
            'message'=>'success'
        ];
        return response()->json($data);
    }
    public function delete(PostCategory $category)
    {
        $category->delete();
        $data=[
            'message'=>'success'
        ];
        return response()->json($data);
    }
}
