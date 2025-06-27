<h1>Task Reminder</h1>

<p>Hi {{ $task->user->name ?? '' }},</p>

<p>You have a task scheduled for tomorrow:</p>

<ul>
    <li><strong>Name:</strong> {{ $task->name }}</li>
    <li><strong>Description:</strong> {{ $task->description }}</li>
    <li><strong>Priority:</strong> {{ ucfirst($task->priority) }}</li>
    <li><strong>Status:</strong> {{ ucfirst($task->status) }}</li>
</ul>