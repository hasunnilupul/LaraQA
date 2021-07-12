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
                    <div class="flex flex-col justify-center items-end w-full mt-2">
                        <div class="text-sm font-medium text-gray-400">Answered {{ $question->created_date }}</div>
                        <div class="flex mt-2">
                            <a href="{{ $question->user->url }}" class="pr-2 select-none">
                                <img src="{{ $question->user->avatar }}" alt="user-img" class="rounded-full w-8 h-8">
                            </a>
                            <a href="{{ $question->user->url }}" class="text-sm font-bold text-blue-800 mt-2">
                                {{ $question->user->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6">
                <h2 class="text-lg font-bold text-gray-600">{{ $question->answers_count . ' ' . Str::plural('Answer', $question->answers_count) }}</h2>
                <hr class="border-gray-600">
                @foreach ($question->answers as $answer)
                    <div class="flex flex-col justify-start mx-2 py-2 text-gray-600 border-b border-gray-300">                        
                        {!! $answer->body_html !!}
                        <div class="flex flex-col mt-1">
                            <div class="text-sm font-medium text-right text-gray-400">Answered {{ $question->created_date }}</div>
                            <div class="flex justify-end mt-2">
                                <a href="{{ $answer->user->url }}" class="pr-2 select-none">
                                    <img src="{{ $answer->user->avatar }}" alt="user-img" class="rounded-full w-8 h-8">
                                </a>
                                <a href="{{ $answer->user->url }}" class="text-sm font-bold text-blue-800 mt-2">
                                    {{ $answer->user->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
