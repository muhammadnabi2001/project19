<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'text' => 'required|max:255'
        ]);
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);
        
        $data = [
            'Task' => $task,
            'message' => 'success'
        ];
        return response()->json($data);
    }
    public function comment(Request $request)
    {
        $request->validate([
            'task_id'=>'required|number',
            'text'=>'required|max:255|string',
        ]);
        return response()->json($request->user());
        if($request->user()->role =='admin')
        {
            $comment = Comment::create([
                'task_id' => $request->task_id,
                'text' => $request->text
            ]);
            $data=[
                'message'=>'success',
                'Comment'=>$comment
            ];
            return response()->json($data);
        }else
        {
            return response()->json(['error'=>'User not found']);
        }
    }
    public function show()
    {
        $tasks = Task::all();
       // return Auth::user();
        return response()->json($tasks);
    }
}
