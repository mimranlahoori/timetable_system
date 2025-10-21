<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weekly Timetable for') . ' ' . $classroom->name . ' (' . $classroom->section . ')' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-800 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-100 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-col sm:flex-row justify-between mb-6 space-y-4 sm:space-y-0">
                    <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600">
                        {{ __('<< Back to Classrooms') }}
                    </a>
                    <a href="{{ route('classrooms.timetable.create', $classroom) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add Timetable Entry') }}
                    </a>
                </div>

                {{-- Timetable Grid --}}
                <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">

                    @if ($timetables->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400 p-8">No timetable entries found for this classroom. Start by adding one!</p>
                    @else
                        @php
                            // 1. Define the desired order of days
                            $dayOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                            
                            // 2. Get all unique time slots and sort them by start time
                            $availableTimeSlots = $timetables->pluck('timeSlot')->unique()->sortBy('start_time');

                            // 3. Structure data for easy lookup: $schedule[day][time_slot_id] = entry
                            // *** FIX: Removed ->toArray() to keep entries as Eloquent objects ***
                            $schedule = $timetables->groupBy('day_of_week')->map(function ($dayEntries) {
                                return $dayEntries->keyBy('time_slot_id');
                            }); 
                        @endphp

                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-fixed">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    {{-- Corner cell for Time Slot header --}}
                                    <th class="w-1/12 px-2 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider text-center border-r border-gray-200 dark:border-gray-700">Time</th>
                                    
                                    {{-- Day headers --}}
                                    @foreach ($dayOrder as $day)
                                        <th class="w-1/7 px-4 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider text-center">
                                            {{ $day }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                {{-- Loop through each unique time slot to create rows --}}
                                @foreach ($availableTimeSlots as $slot)
                                    <tr class="h-24 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        {{-- Time Slot Column --}}
                                        <td class="w-1/12 px-2 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border-r border-gray-200 dark:border-gray-700">
                                            {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}<br>
                                            <span class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                                            </span>
                                        </td>

                                        {{-- Loop through each day to fill the class slot --}}
                                        @foreach ($dayOrder as $day)
                                            <td class="px-2 py-1 text-center border-l border-gray-200 dark:border-gray-700 align-top">
                                                @if (isset($schedule[$day][$slot->id]))
                                                    @php $entry = $schedule[$day][$slot->id]; @endphp
                                                    <div class="p-1.5 bg-indigo-50 dark:bg-indigo-900/50 border border-indigo-200 dark:border-indigo-700 rounded-lg shadow-sm h-full flex flex-col justify-between">
                                                        {{-- Details --}}
                                                        <div class="text-xs leading-snug">
                                                            <div class="font-bold text-indigo-700 dark:text-indigo-300 truncate" title="{{ $entry->subject->name ?? 'N/A' }}">
                                                                {{ $entry->subject->name ?? 'N/A' }}
                                                            </div>
                                                            <div class="text-gray-600 dark:text-gray-400 font-medium">
                                                                {{ $entry->teacher->name ?? 'N/A' }}
                                                            </div>
                                                            @if($entry->room_no)
                                                                <div class="text-gray-500 dark:text-gray-500 text-xs">
                                                                    Room: {{ $entry->room_no  }}
                                                                </div>
                                                            @endif
                                                        </div>

                                                        {{-- Actions --}}
                                                        <div class="flex justify-center space-x-1 mt-1 text-xs">
                                                            <a href="{{ route('timetable.edit', $entry) }}" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900" title="Edit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                            </a>
                                                            <form action="{{ route('timetable.destroy', $entry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this timetable entry?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900" title="Delete">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- Empty Slot --}}
                                                    <div class="text-xs text-gray-400 dark:text-gray-600 p-2 opacity-50">
                                                        <span class="hidden sm:inline">Free Slot</span>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
