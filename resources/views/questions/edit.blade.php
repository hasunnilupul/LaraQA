<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Question') }}
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
                            <form action="{{ route('questions.update', $question->id) }}" method="post">
                                @method('PUT')
                                @include('questions._form',['buttonText'=>'Update Question'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
