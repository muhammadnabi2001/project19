<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
{
    $posts = DB::table('posts')
        ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
        ->select(
            'posts.id',
            'posts.title',
            'posts.description',
            'posts.text',
            'posts.file',
            'categories.name as category'
        )
        ->get();

    $data = [
        'models' => $posts,
        'message' => 'success',
    ];

    return response()->json($data);
}

}
