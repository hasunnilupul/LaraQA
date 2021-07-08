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
                    <div class="lg:flex lg:items-center lg:justify-between p-4 border-b border-gray-200">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-md font-bold leading-7 text-gray-900 sm:text-lg sm:truncate">
                                {{ $question->title }}
                            </h2>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                <div class="flex items-center text-sm text-gray-500">
                                    {{ Str::limit($question->body, 250) }}
                                </div>
                            </div>
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
