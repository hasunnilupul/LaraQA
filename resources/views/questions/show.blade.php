<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
            {{ $question->title }}
        </h2>
        <div class="ml-auto">
            <a href="{{ route('questions.index') }}"
                class="p-2 rounded-md border text-gray-700 hover:text-gray-100 border-gray-500 hover:bg-gray-500 transition duration-500">Back
                to all questions</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
                <div class="flex justify-start items-start p-4 border border-gray-200 text-gray-600">
                    <div class="flex flex-col justify-center items-center py-1">
                        <a title="This question is usefull" href="#" class="block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-caret-up-fill w-10 h-10 vote" viewBox="0 0 16 16">
                                <path
                                    d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                            </svg>
                        </a>
                        <span class="block text-xl font-bold py-2">1293</span>
                        <a title="This question is not usefull" href="#" class="block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-caret-down-fill w-10 h-10 vote-active" viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                        <a title="Click to mark as favourite question" href="#" class="block mt-2 text-center favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-star-fill w-7 h-7" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <span class="text-xs font-medium lining-nums font-serif">162</span>
                        </a>
                    </div>
                    <div class="flex flex-grow flex-col items-start justify-center pl-3">
                        {!! $question->body_html !!}
                        <div class="flex flex-col justify-center items-end w-full mt-2">
                            <div class="text-sm font-medium text-gray-400">Answered {{ $question->created_date }}
                            </div>
                            <div class="flex mt-2">
                                <a href="{{ $question->user->url }}" class="pr-2 select-none">
                                    <img src="{{ $question->user->avatar }}" alt="user-img"
                                        class="rounded-full w-8 h-8">
                                </a>
                                <a href="{{ $question->user->url }}" class="text-sm font-bold text-blue-600 mt-2">
                                    {{ $question->user->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('answers._index',[
                'answers' => $question->answers,
                'answersCount' => $question->answers_count
            ])
        </div>
    </div>
</x-app-layout>
