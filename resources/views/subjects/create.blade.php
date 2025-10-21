<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Subject for') . ' ' . $classroom->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('classrooms.subjects.store', $classroom) }}" method="POST">
                    @csrf

                    {{-- Hidden field for classroom_id (redundant due to route but good for clarity) --}}
                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">


                    {{-- Teacher Name --}}
                    <div class="mb-4">
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tecaher Name') }}<span
                                class="text-red-500">*</span></label>
                        <select name="teacher_id"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Subject Name --}}
                    <div class="mb-4">
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject Name') }}<span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subject Code (Optional) --}}
                    <div class="mb-6">
                        <label for="code"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject Code (Optional)') }}</label>
                        <input type="text" name="code" id="code"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            value="{{ old('code') }}">
                        @error('code')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end">
                        <a href="{{ route('classrooms.subjects.index', $classroom) }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Save Subject') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
