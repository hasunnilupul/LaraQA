<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
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
                <div class="flex justify-start items-start p-4 border border-gray-200 text-gray-600">
                    <vote name="question" :model="{{$question}}" iconsize="w-10 h-10"></vote>
                    
                    <div class="flex flex-grow flex-col items-start justify-center pl-3">
                        {!! $question->body_html !!}
                        <div class="flex flex-col justify-center items-end w-full mt-2">
                            <user-info :model="{{ $question }}" :label="'Asked'"></user-info>
                        </div>
                    </div>
                </div>
            </div>
            <answers :answers="{{$question->answers}}" :count="{{$question->answers_count}}"/>
        </div>
    </div>
</x-app-layout>
