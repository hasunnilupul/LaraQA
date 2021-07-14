<div class="text-sm font-medium text-gray-400">
    {{ $label." ".$model->created_date }}</div>
<div class="flex justify-end mt-2">
    <a href="{{ $model->user->url }}" class="pr-2 select-none">
        <img src="{{ $model->user->avatar }}" alt="user-img" class="rounded-full w-8 h-8">
    </a>
    <a href="{{ $model->user->url }}" class="text-sm font-bold text-blue-600 mt-2">
        {{ $model->user->name }}
    </a>
</div>