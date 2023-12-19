<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Creating a new update
                    </h5>
                </div>
                <p class="mb-4 text-neutral-500">Creating a new timeline by providing a title and description for the
                    project {{$project->name}}</p>

                <form method="post" action="{{route('admin.projects.timeline.store', $project)}}">
                    @csrf

                    <div class="form-inputs my-2 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <x-input-label for="title" value="Title" />
                            <x-text-input name="title" label="title" placeholder="Eg. John Doe" required />
                            @error('title')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="description" value="Description" />
                            <x-text-input name="description" label="description"
                                placeholder="Eg. X and y updates are completed" required />
                            @error('description')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <x-primary-button type="submit" class="max-w-fit">
                            <span>Add update &rarr;</span>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>