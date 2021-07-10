<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $question->title }}
        </h2>
        <div class="ml-auto">
            <a href="{{ route('questions.index') }}"
                class="p-2 rounded-md border text-gray-700 hover:text-gray-100 border-gray-500 hover:bg-gray-500 transition duration-500">Back
                to all questions</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
                <div class="flex flex-col items-start justify-center p-4 border border-gray-200 text-gray-600">
                    {!! $question->body_html !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
