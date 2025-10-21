<x-app-layout><x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Classroom Details: ') . $classroom->name }}</h2></x-slot><div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        {{-- Card Background changes from white to dark-gray-800 --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

            <div class="space-y-4">
                {{-- Name --}}
                <div>
                    {{-- Label text color adjusted for dark mode --}}
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Name') }}</p>
                    {{-- Value text color adjusted for dark mode --}}
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $classroom->name }}</p>
                </div>

                {{-- Section --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Section') }}</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $classroom->section ?? 'N/A' }}</p>
                </div>

                {{-- Created At --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Created On') }}</p>
                    <p class="text-sm text-gray-900 dark:text-gray-100">{{ $classroom->created_at->format('M d, Y H:i A') }}</p>
                </div>

                {{-- Updated At --}}
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Last Updated') }}</p>
                    <p class="text-sm text-gray-900 dark:text-gray-100">{{ $classroom->updated_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                {{-- Button colors adjusted for dark mode --}}
                <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
            </div>

        </div>
    </div>
</div>
</x-app-layout>
