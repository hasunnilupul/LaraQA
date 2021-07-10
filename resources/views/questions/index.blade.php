<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Questions') }}
        </h2>
        <div class="ml-auto">
            <a href="{{ route('questions.create') }}"
                class="p-2 rounded-md border text-gray-700 hover:text-gray-100 border-gray-500 hover:bg-gray-500 transition duration-500">Ask
                question</a>
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
                                <span
                                    class="text-xs font-light text-gray-500">{{ Str::plural('vote', $question->votes) }}</span>
                            </div>
                            <div
                                class="flex flex-col w-full items-center justify-center px-1 mb-2 {{ $question->status }}">
                                <strong class="text-md font-bold text-gray-600">{{ $question->answers }}</strong>
                                <span
                                    class="text-xs font-light text-gray-500">{{ Str::plural('answer', $question->answers) }}</span>
                            </div>
                            <div class="flex w-full items-center justify-center px-1">
                                <strong
                                    class="text-xs font-light text-gray-600">{{ $question->views . ' ' . Str::plural('view', $question->views) }}</strong>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0 sm:border-l-2 sm:border-gray-200 sm:pl-2">
                            <div class="flex items-center">
                                <h2 class="text-md font-bold leading-7 sm:text-lg sm:truncate">
                                    <a href="{{ $question->url }}"
                                        class="text-gray-600 hover:text-gray-800 hover:underline">{{ $question->title }}</a>
                                </h2>
                            </div>
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
                        <div class="flex flex-col flex-grow-0 sm:w-18 items-start justify-center sm:pl-2">
                            <a href="{{ route('questions.edit', $question->id) }}"
                                class="px-2 py-1 mb-4 border border-blue-500 text-gray-600 rounded text-sm font-semibold hover:bg-blue-500 hover:text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="px-2 py-1 border border-red-500 text-gray-600 rounded text-sm font-semibold hover:bg-red-500 hover:text-gray-100"
                                    onclick="return confirm('Are you sure?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 mx-4">
                {{ $questions->links() }}
            </div>
        </div>
    </div>

    @include('components._notifications')
</x-app-layout>
