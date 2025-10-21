<x-app-layout><x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Subject Details: ') . $subject->name }}</h2></x-slot><div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        {{-- Dark mode card background --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

            <div class="space-y-6">
                {{-- Subject Name --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Subject Name') }}</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $subject->name }}</p>
                </div>

                {{-- Subject Code --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Code') }}</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $subject->code ?? 'N/A' }}</p>
                </div>

                {{-- Subject Code --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Teacher of Subject') }}</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $subject->teachers->pluck('name')->join(', ') ?: 'N/A' }}</p>
                </div>

                <hr class="dark:border-gray-700">

                {{-- Associated Classroom --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Assigned Classroom') }}</p>
                    <p class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ $subject->classroom->name }} (Section: {{ $subject->classroom->section ?? 'N/A' }})
                    </p>
                </div>

                {{-- Created At --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Created On') }}</p>
                    <p class="text-sm text-gray-900 dark:text-gray-100">{{ $subject->created_at->format('M d, Y H:i A') }}</p>
                </div>

                {{-- Updated At --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Last Updated') }}</p>
                    <p class="text-sm text-gray-900 dark:text-gray-100">{{ $subject->updated_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                {{-- Link back to the subject index of the parent classroom --}}
                <a href="{{ route('classrooms.subjects.index', $subject->classroom) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to Subjects List') }}
                </a>
            </div>

        </div>
    </div>
</div>
</x-app-layout>
