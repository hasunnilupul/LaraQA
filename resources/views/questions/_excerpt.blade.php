<div class="sm:flex sm:items-center sm:justify-between p-4 border-b last:border-0 border-gray-200 hover:bg-gray-50">
    <div class="flex flex-col flex-grow-0 sm:w-18 items-center justify-center sm:pr-4">
        <div class="flex flex-col w-full items-center justify-center px-1 mb-2">
            <strong class="text-md font-bold text-gray-600">{{ $question->votes_count }}</strong>
            <span class="text-xs font-light text-gray-500">{{ Str::plural('vote', $question->votes_count) }}</span>
        </div>
        <div class="flex flex-col w-full items-center justify-center px-1 mb-2 {{ $question->status }}">
            <strong class="text-md font-bold text-gray-600">{{ $question->answers_count }}</strong>
            <span
                class="text-xs font-light text-gray-500">{{ Str::plural('answer', $question->answers_count) }}</span>
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
            <div class="flex ml-auto">
                @can('update', $question)
                    <a href="{{ route('questions.edit', $question->id) }}"
                        class="px-2 py-1 mr-2 border border-blue-500 text-gray-600 rounded text-sm font-semibold hover:bg-blue-500 hover:text-gray-100">
                        Edit
                    </a>
                @endcan
            </div>
        </div>
        <div class="flex items-baseline mt-1 sm:mt-0 text-sm text-gray-500">
            Asked by
            <a href="{{ $question->user->url }}"
                class="font-semibold text-blue-400 hover:text-blue-600 px-1 hover:underline">{{ $question->user->name }}</a>
            on
            <small class="text-gray-500 px-1">{{ $question->created_date }}</small>
        </div>
        <p class="text-sm text-gray-500 mt-2">
            {{ $question->excerpt }}
        </p>
    </div>
</div>
