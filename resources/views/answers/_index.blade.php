<div class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6">
    <h2 class="text-lg font-bold text-gray-600">
        {{ $answersCount . ' ' . Str::plural('Answer', $answersCount) }}</h2>
    <hr class="border-gray-300">
    @foreach ($answers as $answer)
        <div class="flex justify-start items-start mx-2 py-2 text-gray-600 border-b border-gray-300">
            <div class="flex flex-col justify-center items-center py-1">
                <a title="This answer is usefull" href="#" class="block vote-active {{ Auth::guest() ? 'off':'' }}"
                onclick="event.preventDefault();document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-up-fill w-8 h-8"
                        viewBox="0 0 16 16">
                        <path
                            d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                    </svg>
                </a>
                <form action="/answers/{{ $answer->id }}/vote" method="post"
                    id="up-vote-answer-{{ $answer->id }}" class="hidden">
                    @csrf
                    <input type="hidden" name="vote" value="1"/>
                </form>
                
                <span class="block text-lg font-bold py-2">{{ $answer->votes_count }}</span>
                
                <a title="This answer is not usefull" href="#" class="block vote {{ Auth::guest() ? 'off':'' }}"
                onclick="event.preventDefault();document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-down-fill w-8 h-8"
                        viewBox="0 0 16 16">
                        <path
                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg>
                </a>
                <form action="/answers/{{ $answer->id }}/vote" method="post"
                    id="down-vote-answer-{{ $answer->id }}" class="hidden">
                    @csrf
                    <input type="hidden" name="vote" value="-1"/>
                </form>

                @can('accept', $answer)
                    <a title="Mark this answer as best answer" href="#"
                        class="block mt-2 text-center {{ $answer->status }}"
                        onclick="event.preventDefault();document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-lg h-5 w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                        </svg>
                    </a>
                @else
                    @if ($answer->is_best)
                        <a title="Marked as the best answer by answer owner" href="#"
                        class="block mt-2 text-center {{ $answer->status }}"
                        onclick="event.preventDefault();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-lg h-5 w-5"
                                viewBox="0 0 16 16">
                                <path
                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                            </svg>
                        </a>
                    @endif    
                @endcan
            </div>
            <div class="flex flex-grow flex-col justify-center items-start pl-3">
                {!! $answer->body_html !!}
                <div class="flex flex-auto w-full justify-between items-center mt-1">
                    <div class="flex flex-auto">
                        @can('update', $answer)
                            <a href="{{ route('questions.answers.edit', [$answer->id, $answer->id]) }}"
                                class="px-2 py-1 mr-2 border border-blue-500 text-gray-600 rounded text-sm font-semibold hover:bg-blue-500 hover:text-gray-100">
                                Edit
                            </a>
                        @endcan
                        @can('delete', $answer)
                            <form action="{{ route('questions.answers.destroy', [$answer->id, $answer->id]) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="px-2 py-1 border border-red-500 text-gray-600 rounded text-sm font-semibold hover:bg-red-500 hover:text-gray-100"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                    <div class="flex flex-col justify-end">
                        @include('shared._author', [
                            'model' => $answer,
                            'label' => 'answered'
                        ])
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('answers._create')
</div>
