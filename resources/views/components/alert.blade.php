@props(['type', 'title', 'message'])

@php
$typeClass = '';
$icon = '';
switch ($type) {
    case 'info':
        $typeClass = 'text-gray-500';
        break;
    case 'warning':
        $typeClass = 'text-yellow-500';
        break;
    case 'error':
        $typeClass = 'text-red-500';
        break;
    case 'success':
        $typeClass = 'text-green-500';
        break;
}
@endphp

<div x-data="{isShow: true}">
    <div x-show="isShow" class="w-full mb-2">
        <div class="flex items-center shadow-lg rounded-md space-x-2 bg-white border-gray-100 border px-3"
            x-transition:enter="transition transform ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-0" x-transition:enter-end="opacity-100 translate-y-1"
            x-transition:leave="transition transform ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-1" x-transition:leave-end="opacity-0 translate-y-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-6 w-6 bg-white {{ $typeClass }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                @if ($type == 'info')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                @elseif ($type=='warning')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                @elseif ($type=='error')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                @elseif ($type=='success')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                @endif
            </svg>

            <div class="flex-1 space-y-1 py-2">
                @if ($title)
                    <p class="text-base leading-6 font-semibold antialiased {{ $typeClass }}">{{ $title }}</p>
                @endif
                @if ($message)
                    <p class="text-sm leading-5 text-gray-400 antialiased">{{ $message }}</p>
                @endif
            </div>
            <svg class="flex-shrink-0 h-5 w-5 text-gray-400 cursor-pointer" x-on:click="isShow = false"
                stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-width="1.2"
                    d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z">
                </path>
            </svg>
        </div>
    </div>
</div>
