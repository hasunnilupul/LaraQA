<div class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6">
    <h2 class="text-lg font-bold text-gray-600">
        {{ $answersCount . " " . Str::plural('Answer', $answersCount) }}</h2>
    <hr class="border-gray-300">
    @foreach ($answers as $answer)
        <div class="flex justify-start items-start mx-2 py-2 text-gray-600 border-b border-gray-300">
            <div class="flex flex-col justify-center items-center py-1">
                <a title="This answer is usefull" href="#" class="block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-caret-up-fill w-8 h-8 vote-active" viewBox="0 0 16 16">
                        <path
                            d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                    </svg>
                </a>
                <span class="block text-lg font-bold py-2">132</span>
                <a title="This answer is not usefull" href="#" class="block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-caret-down-fill w-8 h-8 vote" viewBox="0 0 16 16">
                        <path
                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg>
                </a>
                <a title="Mark this answer as best answer" href="#" class="block mt-2 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-lg h-5 w-5 not-accepted" viewBox="0 0 16 16">
                        <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
                      </svg>
                </a>
            </div>
            <div class="flex flex-col justify-center items-start w-full pl-3">
                {!! $answer->body_html !!}
                <div class="flex flex-col w-full justify-center items-end mt-1">
                    <div class="text-sm font-medium text-right text-gray-400">Answered
                        {{ $question->created_date }}</div>
                    <div class="flex justify-end mt-2">
                        <a href="{{ $answer->user->url }}" class="pr-2 select-none">
                            <img src="{{ $answer->user->avatar }}" alt="user-img"
                                class="rounded-full w-8 h-8">
                        </a>
                        <a href="{{ $answer->user->url }}" class="text-sm font-bold text-blue-600 mt-2">
                            {{ $answer->user->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    @include('answers._create')
</div>