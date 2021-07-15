<answer inline-template :answer="{{ $answer }}">
    <div class="flex justify-start items-start mx-2 py-2 text-gray-600 border-b last:border-0 border-gray-300">
        <div class="flex flex-col justify-center items-center py-1">
            <a title="This answer is usefull" href="#" class="block vote-active {{ Auth::guest() ? 'off' : '' }}"
                onclick="event.preventDefault();document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-up-fill w-8 h-8"
                    viewBox="0 0 16 16">
                    <path
                        d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                </svg>
            </a>
            <form action="/answers/{{ $answer->id }}/vote" method="post" id="up-vote-answer-{{ $answer->id }}"
                class="hidden">
                @csrf
                <input type="hidden" name="vote" value="1" />
            </form>

            <span class="block text-lg font-bold py-2">{{ $answer->votes_count }}</span>

            <a title="This answer is not usefull" href="#" class="block vote {{ Auth::guest() ? 'off' : '' }}"
                onclick="event.preventDefault();document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-down-fill w-8 h-8"
                    viewBox="0 0 16 16">
                    <path
                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
            </a>
            <form action="/answers/{{ $answer->id }}/vote" method="post" id="down-vote-answer-{{ $answer->id }}"
                class="hidden">
                @csrf
                <input type="hidden" name="vote" value="-1" />
            </form>

            @can('accept', $answer)
                <a title="Mark this answer as best answer" href="#" class="block mt-2 text-center {{ $answer->status }}"
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
                        class="block mt-2 text-center {{ $answer->status }}" onclick="event.preventDefault();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-lg h-5 w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                        </svg>
                    </a>
                @endif
            @endcan
        </div>
        <div class="flex flex-grow flex-col justify-center items-start ml-3" v-if="editing">
            <form @submit.prevent="update" class="w-full">
                <div class="mt-1">
                    <textarea id="body" v-model="body" rows="7" maxlength="1000" required
                        class="mt-1 {{ $errors->has('body') ? 'focus:ring-red-400 focus:border-red-500 border-red-300' : 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' }}  block w-full shadow-sm sm:text-sm text-gray-600 rounded-md"
                        placeholder="You are going to post an answer for this question."></textarea>
                </div>
                <div class="py-3 text-left">
                    <button type="submit" :disabled="isInvalid"
                        class="inline-flex justify-center py-1 px-2 mr-2 shadow-sm text-sm font-semibold rounded text-white bg-indigo-600 focus:outline-none disabled:opacity-50">Update</button>
                    <button @click="cancel" type="button"
                        class="inline-flex justify-center py-1 px-2 border border-gray-600 shadow-sm text-sm font-semibold rounded text-gray-600 hover:text-white focus:text-white hover:bg-gray-600 focus:bg-gray-600 focus:outline-none">Cancel</button>

                </div>
            </form>
        </div>
        <div class="flex flex-grow flex-col justify-center items-start ml-3" v-else>
            <div v-html="bodyHtml"></div>
            <div class="flex flex-auto w-full justify-between items-center mt-1">
                <div class="flex flex-auto">
                    @can('update', $answer)
                        <button @click="edit" type="button"
                            class="px-2 py-1 mr-2 border border-blue-500 shadow-sm text-gray-600 rounded text-sm font-semibold hover:bg-blue-500 focus:bg-blue-500 hover:text-gray-100 focus:text-gray-100 cursor-pointer">
                            Edit
                        </button>
                    @endcan
                    @can('delete', $answer)
                        <form action="{{ route('questions.answers.destroy', [$answer->id, $answer->id]) }}"
                            method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit"
                                class="px-2 py-1 border border-red-500 shadow-sm text-gray-600 rounded text-sm font-semibold hover:bg-red-500 focus:bg-red-500 hover:text-gray-100 focus:text-gray-100 cursor-pointer"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
                <div class="flex flex-col justify-end">
                    <user-info :model="{{ $answer }}" :label="'Answered'"></user-info>
                </div>
            </div>
        </div>
    </div>
</answer>
