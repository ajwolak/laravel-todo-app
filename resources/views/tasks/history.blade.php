<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            History: {{ $task->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 space-y-4">
        @forelse ($histories as $history)
        <div class="bg-white border border-gray-200 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-2">
                <div class="text-sm text-gray-500">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $history->created_at->format('Y-m-d H:i') }}
                    </span>
                </div>
                <div class="text-sm text-gray-600 italic">
                    by <strong>{{ $history->user->name ?? 'Unknown user' }}</strong>
                </div>
            </div>

            <div class="mt-2">
                <ul class="space-y-1 text-sm text-gray-700">
                    @foreach ($history->changed_fields as $field => [$old, $new])
                    <li class="flex items-start">
                        <span class="w-28 font-medium text-gray-800">{{ ucfirst($field) }}:</span>
                        <span class="flex-1">
                            <span class="line-through text-red-500">{{ $old }}</span>
                            <span class="mx-1">→</span>
                            <span class="text-green-600 font-semibold">{{ $new }}</span>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 text-sm">No change history available.</p>
        @endforelse

        <div class="mt-6 ">
            <a href="{{ route('tasks.index') }}" class="inline-block text-blue-600 hover:text-blue-800 underline">
                ← Back to task list
            </a>
        </div>
    </div>
</x-app-layout>