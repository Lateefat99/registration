<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="get" action="{{route('tasks.edit', 'task')}}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <input type="hidden" name="id" value="{{$task->id}}">
                            <label for="description" class="block font-medium text-sm text-gray-300">
                                Description
                            </label>
                            <input type="text" name="description" id="description" value="{{$task->description}}">
                            @error('description')
                            <p class="text-sm text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-red-50">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800"> Update </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
