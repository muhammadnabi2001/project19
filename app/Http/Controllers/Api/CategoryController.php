<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $models=Category::all();
        return CategoryResource::collection($models);
    }
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|max:255'
        ]);
        $category=new Category();
        $category->name=$request->name;
        $category->save();

        return response()->json($category);
    }
    public function show()
    {
        $category=Category::all();
        return response()->json($category);
    }
}
