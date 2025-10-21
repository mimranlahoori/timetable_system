<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Entry to Timetable for') . ' ' . $classroom->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <form action="{{ route('classrooms.timetable.store', $classroom) }}" method="POST">
                    @csrf

                    {{-- Day of Week --}}
                    <div class="mb-4">
                        <label for="day_of_week" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Day of Week') }}<span class="text-red-500">*</span></label>
                        <select name="day_of_week" id="day_of_week" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Select Day --</option>
                            @foreach ($days as $day)
                                <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('day_of_week')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Time Slot --}}
                    <div class="mb-4">
                        <label for="time_slot_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Time Slot') }}<span class="text-red-500">*</span></label>
                        <select name="time_slot_id" id="time_slot_id" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Select Time Slot --</option>
                            @foreach ($timeSlots as $slot)
                                <option value="{{ $slot->id }}" {{ old('time_slot_id') == $slot->id ? 'selected' : '' }}>
                                    {{ $slot->start_time }} - {{ $slot->end_time }}
                                </option>
                            @endforeach
                        </select>
                        @error('time_slot_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subject --}}
                    <div class="mb-4">
                        <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject') }}<span class="text-red-500">*</span></label>
                        <select name="subject_id" id="subject_id" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }} ({{ $subject->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Teacher --}}
                    <div class="mb-4">
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Teacher') }}<span class="text-red-500">*</span></label>
                        <select name="teacher_id" id="teacher_id" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Select Teacher --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Room No. (Optional) --}}
                    <div class="mb-6">
                        <label for="room_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Room No. (Optional)') }}</label>
                        <input type="text" name="room_no" id="room_no" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('room_no') }}">
                        @error('room_no')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end">
                        <a href="{{ route('classrooms.timetable.index', $classroom) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Save Entry') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
