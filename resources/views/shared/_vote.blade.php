@if ($model instanceof App\Models\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
        $iconSize = 'w-10 h-10'
    @endphp
@elseif ($model instanceof App\Models\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
        $iconSize = 'w-8 h-8'
    @endphp
@endif

@php
$formId = $name . '-' . $model->id;
$formAction = '/' . $firstURISegment . '/' . $model->id . '/vote'
@endphp
