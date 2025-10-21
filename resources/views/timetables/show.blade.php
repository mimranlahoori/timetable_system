<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Timetable Entry Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="space-y-6">
                    {{-- Classroom --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Classroom') }}</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $timetable->classroom->name ?? 'N/A' }} ({{ $timetable->classroom->section ?? '' }})
                        </p>
                    </div>

                    {{-- Day of Week --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Day of Week') }}</p>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $timetable->day_of_week }}</p>
                    </div>

                    {{-- Time Slot --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Time Slot') }}</p>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                            {{ $timetable->timeSlot->start_time ?? 'N/A' }} - {{ $timetable->timeSlot->end_time ?? 'N/A' }}
                        </p>
                    </div>

                    {{-- Subject --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Subject') }}</p>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $timetable->subject->name ?? 'N/A' }}</p>
                    </div>
                    
                    {{-- Teacher --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Teacher') }}</p>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $timetable->teacher->name ?? 'N/A' }}</p>
                    </div>

                    {{-- Room No. --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Room No.') }}</p>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $timetable->room_no ?? 'Not Assigned' }}</p>
                    </div>

                    {{-- Timestamps --}}
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Created: {{ $timetable->created_at->format('M d, Y h:i A') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Last Updated: {{ $timetable->updated_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>

                {{-- Back and Edit Buttons --}}
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('classrooms.timetable.index', $timetable->classroom) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600">
                        {{ __('Back to Timetable') }}
                    </a>
                    <a href="{{ route('timetable.edit', $timetable) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Edit Entry') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
