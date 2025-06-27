<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Http\Controllers\TaskHistoryController;

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->name('dashboard');;
Route::get('/', function () {
    return redirect()->route('tasks.index');
});


Route::get('/public-task/{token}', function ($token) {
    $task = Task::where('access_token', $token)->first();

    if (! $task || $task->token_expiration < now()) {
        return response()->view('tasks.token_expired', [], 410);
    }

    return view('tasks.public', compact('task'));
})->name('tasks.public');

Route::middleware('auth')->group(function () {
    Route::get('/tasks/{task}/history', [TaskHistoryController::class, 'index'])->name('tasks.history');
    Route::post('/tasks/{task}/share', [TaskController::class, 'share'])->name('tasks.share');
    Route::resource('tasks', TaskController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
