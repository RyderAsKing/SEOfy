<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Plans') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-2">
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                href="{{route('admin.plans.create')}}">Create plan &rarr;</a>
        </div>
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

                        <th scope="col" class="px-6 py-3 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($plans->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">No projects found.</td>
                    </tr>
                    @endif

                    @foreach($plans as $plan)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4">
                            {{Str::limit($plan->name, 32)}}
                        </th>
                        <td class="px-6 py-4">
                            {{Str::limit($plan->description, 42)}}
                        </td>

                        <td class="p-4 max-h flex gap-4 justify-end">
                            <a href="{{route('admin.plans.edit', $plan)}}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="{{route('admin.plans.show', $plan)}}"
                                class="font-medium text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$plans->links()}}
        </div>
    </div>
</x-app-layout>