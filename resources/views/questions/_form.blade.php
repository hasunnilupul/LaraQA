@csrf
<div class="shadow overflow-hidden sm:rounded-md">
    <div class="px-4 py-5 bg-white sm:p-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-5">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $question->title) }}" id="title" autocomplete="title"
                    class="mt-1 {{ $errors->has('title') ? 'focus:ring-red-400 focus:border-red-500 border-red-300' : 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm rounded-md">

                @if ($errors->has('title'))
                    <div class="block ml-2">
                        <strong class="text-sm font-medium text-red-500">{{ $errors->first('title') }}</strong>
                    </div>
                @endif
            </div>

            <div class="col-span-6" x-data="{question-body:''}">
                <label for="body" class="block text-sm font-medium text-gray-700">
                    Brief description
                </label>
                <div class="mt-1">
                    <textarea id="body" x-model="body" name="body" rows="10" maxlength="1000"
                        class="mt-1 {{ $errors->has('body') ? 'focus:ring-red-400 focus:border-red-500 border-red-300' : 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm rounded-md"
                        placeholder="How can i publish a question in LaraQA because i have faced several problems trying to publish a Java question.">{{ old('body', $question->body) }}</textarea>
                </div>

                @if ($errors->has('body'))
                    <div class="block ml-2">
                        <strong class="text-sm font-medium text-red-500">{{ $errors->first('body') }}</strong>
                    </div>
                @endif
                <p class="mt-2 text-sm text-gray-500">
                    Explain your question. Maximum 1000 characters.
                </p>
            </div>
        </div>
    </div>
    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ $buttonText }}
        </button>
    </div>
</div>
