<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->tasks();

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,done',
            'due_date' => 'required|date',
        ]);

        auth()->user()->tasks()->create($data);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $original = $task->only(['name', 'description', 'priority', 'status', 'due_date']);

        $task->update($request->only(['name', 'description', 'priority', 'status', 'due_date']));

        $changes = [];
        foreach ($original as $key => $value) {
            if ($task->$key != $value) {
                $changes[$key] = [$value, $task->$key];
            }
        }

        if (!empty($changes)) {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'changed_fields' => $changes,
            ]);
        }

        return redirect()->route('tasks.index');
    }


    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function share(Task $task)
    {
        $task->update([
            'access_token' => Str::random(32),
            'token_expiration' => now()->addHours(24),
        ]);

        $link = route('tasks.public', $task->access_token);

        return redirect()->back()->with('public_link', $link);
    }
    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
