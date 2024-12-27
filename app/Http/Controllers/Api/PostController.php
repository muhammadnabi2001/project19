<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::all();
      // return response()->json('success');
        return PostResource::collection($posts);
    }
   
   
}
