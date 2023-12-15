<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$user->name}}</h5>
                </div>
                <p class="mb-4 text-neutral-500">{{$user->email}}</p>

                @if(auth()->user()->is_admin)
                <a href="{{route('admin.users.edit', $user)}}"
                    class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                    <span>Edit User &rarr;</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>