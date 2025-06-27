<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">

        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold">{{ $task->name }}</h3>
                <p class="text-sm text-gray-600">Status: <span class="font-medium">{{ ucfirst($task->status) }}</span></p>
                <p class="text-sm text-gray-600">Priority: <span class="font-medium">{{ ucfirst($task->priority) }}</span></p>
                <p class="text-sm text-gray-600">Deadline: {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</p>
                @if($task->description)
                <p class="mt-2 text-gray-700">{{ $task->description }}</p>
                @endif
            </div>
        </div>



    </div>
</x-guest-layout>