<div class="flex flex-col my-4 mx-4">    
    <h2 class="text-lg font-bold text-gray-600">{{ __('Your answer') }}</h2>
    <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
        @csrf
        <div class="px-4 py-2 bg-white">
            <div class="mt-1">
                <textarea id="body" name="body" rows="7" maxlength="500"
                    class="mt-1 {{ $errors->has('body') ? 'focus:ring-red-400 focus:border-red-500 border-red-300' : 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm text-gray-600 rounded-md"
                    placeholder="You are going to post an answer for this question.">{{ old('body', $answer->body) }}</textarea>
            </div>

            @if ($errors->has('body'))
                <div class="block ml-2">
                    <strong class="text-sm font-medium text-red-500">{{ $errors->first('body') }}</strong>
                </div>
            @endif
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Post answer') }}
            </button>
        </div>
    </form>
</div>