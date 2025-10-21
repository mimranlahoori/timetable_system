<x-app-layout><x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit Subject: ') . $subject->name }}</h2></x-slot><div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        {{-- Dark mode card background --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

            {{-- Form action targets the update method and uses PUT method spoofing --}}
            <form action="{{ route('subjects.update', $subject) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Display Classroom Context --}}
                <div class="mb-6 p-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Part of Classroom:
                    </p>
                    <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ $subject->classroom->name }} (Section: {{ $subject->classroom->section ?? 'N/A' }})
                    </p>
                </div>

                {{-- Subject Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject Name') }}<span class="text-red-500">*</span></label>
                    {{-- Dark mode input styling --}}
                    <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('name', $subject->name) }}">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Subject Code (Optional) --}}
                <div class="mb-6">
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject Code (Optional)') }}</label>
                     {{-- Dark mode input styling --}}
                    <input type="text" name="code" id="code" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('code', $subject->code) }}">
                    @error('code')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end border-t dark:border-gray-700 pt-4">
                    {{-- Link back to the subject index of the parent classroom --}}
                    <a href="{{ route('classrooms.subjects.index', $subject->classroom) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">{{ __('Cancel') }}</a>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Update Subject') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
</x-app-layout>
