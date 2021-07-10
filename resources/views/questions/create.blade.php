<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ask Question') }}
        </h2>
        <div class="ml-auto">
            <a href="{{ route('questions.index') }}"
                class="p-2 rounded-md border text-gray-700 hover:text-gray-100 border-gray-500 hover:bg-gray-500 transition duration-500">Back
                to all questions</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-5">
            <div class="overflow-hidden">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Question Information</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Use precise keywords and a well explained title for best results.
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('questions.store') }}" method="post">
                                @csrf
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-5">
                                                <label for="question-title"
                                                    class="block text-sm font-medium text-gray-700">Title</label>
                                                <input type="text" name="question-title" id="question-title"
                                                    autocomplete="question-title"
                                                    class="mt-1 {{ $errors->has('title')? 'focus:ring-red-400 focus:border-red-500 border-red-300':'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm rounded-md">                                                
                                                
                                                @if($errors->has('title'))
                                                    <div class="block ml-2">
                                                        <strong class="text-sm font-medium text-red-500">{{ $errors->first('title') }}</strong>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-span-6" x-data="{body:''}">
                                                <label for="question-body"
                                                    class="block text-sm font-medium text-gray-700">
                                                    Brief description
                                                    <span x-text="body.length+'/1000'" class="text-xs font-normal sm:ml-auto" :class="{'text-blue-700':body.length<1000, 'text-red-500':body.length>=1000}"></span>
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="question-body" x-model="body" name="question-body" rows="10" maxlength="1000"
                                                        class="mt-1 {{ $errors->has('title')? 'focus:ring-red-400 focus:border-red-500 border-red-300':'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm rounded-md"
                                                        placeholder="How can i publish a question in LaraQA because i have faced several problems trying to publish a Java question."></textarea>
                                                </div>

                                                @if($errors->has('body'))
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
                                            Publish
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-alert-container>
        <x-alert type="info">
            <x-slot name="title">
                Successfully saved!
            </x-slot>
            <x-slot name="message">
                Anyone with a link can now view this file
            </x-slot>
        </x-alert>
    </x-alert-container>
</x-app-layout>
