<div class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6" v-cloak>
    @if ($answersCount > 0)
        <h2 class="text-lg font-bold text-gray-600">
            {{ $answersCount . ' ' . Str::plural('Answer', $answersCount) }}</h2>
        <hr class="border-gray-300">
        <div class="answers-list">
            @foreach ($answers as $answer)
                @include('answers._answer')
            @endforeach
        </div>
    @endif

    @include('answers._create')
</div>
