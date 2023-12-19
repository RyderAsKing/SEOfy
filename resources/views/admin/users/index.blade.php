<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Users') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-2">
            <x-primary-link href="{{route('admin.users.create')}}">Create user &rarr;</x-primary-link>
            <form method="get" action="{{route('admin.users.index')}}"
                class="form-group  flex gap-2 items-center justify-end">
                <x-text-input type="text" name="search" placeholder="Search users" wire:model="search" />
                <x-primary-button type="submit">Search</x-primary-button>
            </form>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Admin
                        </th>

                        <th scope="col" class="px-6 py-3 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @if($users->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">No users found.</td>
                    </tr>
                    @endif

                    @foreach($users as $user)

                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{$user->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$user->email}}
                        </td>
                        <td class="px-6 py-4">
                            @if($user->is_admin) <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">yes</span>
                            @else <span
                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">no</span>
                            @endif
                        </td>

                        <td class="py-4 max-h flex gap-4 justify-end">
                            <a href="{{route('admin.users.edit', $user)}}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="{{route('admin.users.show', $user)}}"
                                class="font-medium text-blue-600 hover:underline">View</a>
                            <a href="{{route('impersonate', $user->id)}}"
                                class="font-medium text-blue-600 hover:underline mr-2">Impersonate</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$users->links()}}
        </div>
    </div>
</x-app-layout>