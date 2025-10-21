<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 leading-tight">
            📊 Dashboard Overview
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 space-y-8">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Classes --}}
            <div
                class="bg-gradient-to-br from-indigo-600 to-indigo-500 dark:from-indigo-700 dark:to-indigo-600 text-white rounded-xl p-6 shadow-lg">
                <h3 class="text-sm font-medium text-indigo-100">Total Classes</h3>
                <p class="mt-2 text-4xl font-bold">{{ $totalClasses }}</p>
            </div>

            {{-- Teachers --}}
            <div
                class="bg-gradient-to-br from-emerald-600 to-emerald-500 dark:from-emerald-700 dark:to-emerald-600 text-white rounded-xl p-6 shadow-lg">
                <h3 class="text-sm font-medium text-emerald-100">Total Teachers</h3>
                <p class="mt-2 text-4xl font-bold">{{ $totalTeachers }}</p>
            </div>

            {{-- Subjects --}}
            <div
                class="bg-gradient-to-br from-yellow-500 to-yellow-400 dark:from-yellow-600 dark:to-yellow-500 text-white rounded-xl p-6 shadow-lg">
                <h3 class="text-sm font-medium text-yellow-100">Total Subjects</h3>
                <p class="mt-2 text-4xl font-bold">{{ $totalSubjects }}</p>
            </div>

            {{-- Time Slots --}}
            <div
                class="bg-gradient-to-br from-pink-500 to-pink-400 dark:from-pink-600 dark:to-pink-500 text-white rounded-xl p-6 shadow-lg">
                <h3 class="text-sm font-medium text-pink-100">Time Slots</h3>
                <p class="mt-2 text-4xl font-bold">{{ $totalSlots }}</p>
            </div>
        </div>


        {{-- Today's Timetable --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                🗓️ Today’s Timetable ({{ $today }})
            </h3>

            @if($todayTimetables->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-200 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="py-2 px-4">Class</th>
                                <th class="py-2 px-4">Subject</th>
                                <th class="py-2 px-4">Teacher</th>
                                <th class="py-2 px-4">Time</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-200">
                            @foreach($todayTimetables as $item)
                                <tr
                                    class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="py-2 px-4">{{ $item->classroom->name }}</td>
                                    <td class="py-2 px-4">{{ $item->subject->name }}</td>
                                    <td class="py-2 px-4">{{ $item->teacher->name }}</td>
                                    <td class="py-2 px-4">
                                        {{ \Carbon\Carbon::parse($item->timeSlot->start_time)->format('H:i A') }} ---
                                        {{ \Carbon\Carbon::parse($item->timeSlot->end_time)->format('H:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-400 mt-4">No classes scheduled for today.</p>
            @endif
        </div>

        {{-- Quick Links --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                ⚡ Quick Actions
            </h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('teachers.index') }}"
                    class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-4 py-2 rounded-lg transition">
                    Manage Teachers
                </a>
                <a href="{{ route('classrooms.index') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition">
                    Manage Classes
                </a>
            </div>
        </div>
    </div>
</x-app-layout>