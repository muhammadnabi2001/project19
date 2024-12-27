<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'text'=>'required|max:255'
        ]);
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);
        $comment=Comment::create([
            'task_id'=>$task->id,
            'text'=>$request->text
        ]);
        $data=[
            'Task'=>$task,
            'Comment'=>$comment,
            'message'=>'success'
        ];
        return response()->json($data);
    }
    public function show()
    {
        $tasks=Task::all();
        return response()->json($tasks);
    }
}
