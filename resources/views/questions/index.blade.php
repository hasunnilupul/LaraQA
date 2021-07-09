<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Questions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
                @foreach ($questions as $question)
                    <div
                        class="lg:flex lg:items-center lg:justify-between p-4 border-b border-gray-200 hover:bg-gray-50">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-md font-bold leading-7 sm:text-lg sm:truncate">
                                <a href="{{ $question->url }}"
                                    class="text-gray-600 hover:text-gray-800 hover:underline">{{ $question->title }}</a>
                            </h2>
                            <div class="flex items-baseline mt-1 sm:mt-0 text-sm">
                                Asked by
                                <a href="{{ $question->user->url }}"
                                    class="font-semibold text-blue-400 hover:text-blue-600 px-1 hover:underline">{{ $question->user->name }}</a>
                                on
                                <small class="text-gray-400 px-1">{{ $question->created_date }}</small>
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
