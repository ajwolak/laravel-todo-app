<?php

namespace App\Http\Controllers;

use App\Models\Task;


class TaskHistoryController extends Controller
{
    public function index(Task $task)

    {

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        $histories = $task->histories()->with('user')->latest('created_at')->get();

        return view('tasks.history', compact('task', 'histories'));
    }
}
