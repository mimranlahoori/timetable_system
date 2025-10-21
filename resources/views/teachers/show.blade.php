<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Teacher Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ __('Name') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ $teacher->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ __('Email') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ $teacher->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ __('Phone') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ $teacher->phone ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ __('Subject Specialization') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ $teacher->subject_specialization ?? 'General' }}
                        </p>
                    </div>

                    <div class="pt-6 flex justify-end space-x-3">
                        <a href="{{ route('teachers.edit', $teacher) }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md">
                            {{ __('Edit') }}
                        </a>
                        <a href="{{ route('teachers.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-md hover:bg-gray-400 dark:hover:bg-gray-600">
                            {{ __('Back to List') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
