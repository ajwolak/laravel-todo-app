<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;
use Carbon\Carbon;

class SendTaskReminderEmails extends Command
{
    protected $signature = 'tasks:send-reminders';
    protected $description = 'Send email reminders for tasks scheduled for tomorrow';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $tasks = Task::whereDate('due_date', $tomorrow)->with('user')->get();

        foreach ($tasks as $task) {
            if ($task->user && $task->user->email) {
                Mail::to($task->user->email)->queue(new TaskReminderMail($task));
            }
        }

        $this->info('Task reminder emails sent successfully.');
    }
}
