<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New task
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <form method="POST" action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" class="space-y-6 bg-white p-6 shadow rounded-lg">
            @csrf
            @if(isset($task))
            @method('PUT')
            @endif

            <div>
                <label for="name" class="block font-medium">Task name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $task->name ?? '') }}" required maxlength="255" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div>
                <label for="description" class="block font-medium">Description</label>
                <textarea id="description" name="description" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $task->description ?? '') }}</textarea>
            </div>

            <div>
                <label for="priority" class="block font-medium">Priority</label>
                <select id="priority" name="priority" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach(['low', 'medium', 'high'] as $priority)
                    <option value="{{ $priority }}" {{ old('priority', $task->priority ?? '') === $priority ? 'selected' : '' }}>
                        {{ ucfirst($priority) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block font-medium">Status</label>
                <select id="status" name="status" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach(['to-do', 'in progress', 'done'] as $status)
                    <option value="{{ $status }}" {{ old('status', $task->status ?? '') === $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="due_date" class="block font-medium">Deadline</label>
                <input id="due_date" type="date" name="due_date" value="{{ old('due_date', isset($task) ? $task->due_date->format('Y-m-d') : '') }}" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Add
                </button>
            </div>
        </form>
        <div class="mt-6">
            <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">← Back to task list</a>
        </div>
    </div>
</x-app-layout>