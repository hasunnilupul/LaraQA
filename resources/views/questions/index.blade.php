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
                @forelse ($questions as $question)
                    @include('questions._excerpt')
                @empty
                    <div class="sm:flex sm:items-center sm:justify-start p-4 border-b bg-yellow-200 text-yellow-800 border-yellow-200">
                        <strong class="pr-1">Sorry</strong>there are no questions available.    
                    </div>   
                @endforelse
            </div>

            <div class="mt-6 mx-4">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
