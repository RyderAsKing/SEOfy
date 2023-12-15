<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Projects') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="get" action="{{route('admin.projects.index')}}"
            class="form-group mb-2 flex gap-2 items-center justify-end">
            <x-text-input type="text" name="search" placeholder="Search projects" wire:model="search" />
            <x-primary-button type="submit">Search</x-primary-button>
        </form>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            URL
                        </th>

                        <th scope="col" class="px-6 py-3 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($projects->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">No projects found.</td>
                    </tr>
                    @endif

                    @foreach($projects as $project)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4">
                            {{Str::limit($project->name, 32)}}
                        </th>
                        <td class="px-6 py-4">
                            {{Str::limit($project->description, 42)}}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{$project->url}}" target="_blank"
                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{Str::limit($project->url,
                                32)}}</a>
                        </td>

                        <td class="p-4 max-h flex gap-4 justify-end">
                            <a href="{{route('admin.projects.edit', $project)}}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="{{route('admin.projects.show', $project)}}"
                                class="font-medium text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$projects->links()}}
        </div>
    </div>
</x-app-layout>