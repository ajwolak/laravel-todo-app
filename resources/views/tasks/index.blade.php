<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My tasks') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">

        <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-4 mb-6">
            <div>
                <label for="priority" class="block text-sm font-medium">Priority:</label>
                <select name="priority" id="priority" class="border-gray-300 rounded">
                    <option value="">All</option>
                    @foreach(['low', 'medium', 'high'] as $option)
                    <option value="{{ $option }}" @selected(request('priority')==$option)>
                        {{ ucfirst($option) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium">Status:</label>
                <select name="status" id="status" class="border-gray-300 rounded">
                    <option value="">All</option>
                    @foreach(['to-do', 'in progress', 'done'] as $option)
                    <option value="{{ $option }}" @selected(request('status')==$option)>
                        {{ ucfirst($option) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium">Deadline:</label>
                <input type="date" name="due_date" id="due_date" class="border-gray-300 rounded"
                    value="{{ request('due_date') }}">
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Filter
                </button>
                <a href="{{ route('tasks.index') }}"
                    class="ml-2 px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
                    Reset
                </a>
            </div>
        </form>



        <div class="flex justify-end mb-4">
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ New task</a>
        </div>

        @if(session('public_link'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            Public link to the task:
            <a href="{{ session('public_link') }}" target="_blank" class="underline text-blue-600">
                {{ session('public_link') }}
            </a>
        </div>
        @endif

        @forelse($tasks as $task)
        <div class="bg-white shadow rounded-lg p-4 mb-4 border border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">{{ $task->name }}</h3>
                    <p class="text-sm text-gray-600">Status: <span class="font-medium">{{ $task->status }}</span></p>
                    <p class="text-sm text-gray-600">Priority: <span class="font-medium">{{ ucfirst($task->priority) }}</span></p>
                    <p class="text-sm text-gray-600">Deadline: {{ $task->due_date->format('Y-m-d') }}</p>
                </div>
                <div class="flex gap-4 items-center">

                    <a href="{{ route('tasks.edit', $task) }}" title="Edit">
                        <span class="material-icons text-blue-600 hover:text-blue-800">edit</span>
                    </a>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete">
                            <span class="material-icons text-red-600 hover:text-red-800">delete</span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('tasks.share', $task) }}" style="display:inline">
                        @csrf
                        <button type="submit" title="Generate public link">
                            <span class="material-icons text-gray-600 hover:text-gray-800">link</span>
                        </button>
                    </form>
                    <a href="{{ route('tasks.history', $task->id) }}" title="History">
                        <span class="material-icons text-yellow-600 hover:text-yellow-800">history</span>
                    </a>
                </div>

            </div>
        </div>
        @empty
        <div class="text-center text-gray-500">No tasks available</div>
        @endforelse
    </div>
</x-app-layout>