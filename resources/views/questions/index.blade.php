<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Questions') }}
        </h2>
        <div class="ml-auto">
            <a href="{{ route('questions.create') }}" class="p-2 rounded-md border text-gray-700 hover:text-gray-100 border-gray-500 hover:bg-gray-500 transition duration-500">Ask question</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
                @foreach ($questions as $question)
                    <div
                        class="sm:flex sm:items-center sm:justify-between p-4 border-b border-gray-200 hover:bg-gray-50">
                        <div class="flex flex-col flex-grow-0 sm:w-18 items-center justify-center sm:pr-4">
                            <div class="flex flex-col w-full items-center justify-center px-1 mb-2">
                                <strong class="text-md font-bold text-gray-600">{{ $question->votes }}</strong>
                                <span class="text-xs font-light text-gray-500">{{ Str::plural('vote', $question->votes) }}</span>                                
                            </div>
                            <div class="flex flex-col w-full items-center justify-center px-1 mb-2 {{ $question->status }}">
                                <strong class="text-md font-bold text-gray-600">{{ $question->answers }}</strong>
                                <span class="text-xs font-light text-gray-500">{{ Str::plural('answer', $question->answers) }}</span>
                            </div>
                            <div class="flex w-full items-center justify-center px-1">
                                <strong class="text-xs font-light text-gray-600">{{ $question->views." ".Str::plural('view', $question->views) }}</strong>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0 sm:border-l-2 sm:border-gray-200 sm:pl-2">
                            <h2 class="text-md font-bold leading-7 sm:text-lg sm:truncate">
                                <a href="{{ $question->url }}"
                                    class="text-gray-600 hover:text-gray-800 hover:underline">{{ $question->title }}</a>
                            </h2>
                            <div class="flex items-baseline mt-1 sm:mt-0 text-sm text-gray-500">
                                Asked by
                                <a href="{{ $question->user->url }}"
                                    class="font-semibold text-blue-400 hover:text-blue-600 px-1 hover:underline">{{ $question->user->name }}</a>
                                on
                                <small class="text-gray-500 px-1">{{ $question->created_date }}</small>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ Str::limit($question->body, 250) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 mx-4">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
