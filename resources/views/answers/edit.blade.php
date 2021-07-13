<x-app-layout>
    <x-slot name="header">
        <div class="ml-auto">
            <a href="{{ route('questions.index') }}"
                class="p-2 rounded-md border text-gray-700 hover:text-gray-100 border-gray-500 hover:bg-gray-500 transition duration-500">Back
                to all questions</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-5 sm:py-3 lg:py-4 bg-white rounded-sm shadow-md">
            <div class="overflow-hidden">
                <div class="mt-10 sm:mt-0">
                    <h2 class="font-semibold text-xl py-2 text-gray-800 leading-tight border-b border-gray-300">
                        {{ __('Editing answer for question: '). " " .$question->title }}
                    </h2>
                    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}"
                        method="post">
                        @csrf
                        @method('PATCH')
                        <div class="px-4 py-2 bg-white">
                            <div class="mt-1">
                                <textarea id="body" name="body" rows="7" maxlength="1000"
                                    class="mt-1 {{ $errors->has('body') ? 'focus:ring-red-400 focus:border-red-500 border-red-300' : 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm text-gray-600 rounded-md"
                                    placeholder="You are going to post an answer for this question.">{{ old('body', $answer->body) }}</textarea>
                            </div>

                            @if ($errors->has('body'))
                                <div class="block ml-2">
                                    <strong
                                        class="text-sm font-medium text-red-500">{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="px-4 py-3 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Update answer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
