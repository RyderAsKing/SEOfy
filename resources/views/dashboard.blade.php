<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Welcome to
                        {{env('APP_NAME')}}</h5>
                </div>
                <p class="mb-4 text-neutral-500">For offering SEO and keeping the results documented in a clean way for
                    clients</p>

                @if(auth()->user()->is_admin)
                <a href="{{route('users.index')}}"
                    class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                    <span>Manage users &rarr;</span>
                </a>
                @endif
            </div>

            @if(auth()->user()->is_admin)
            <div class="grid grid-cols-3 mt-2 gap-2">
                <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block mb-3">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$users}}</h5>
                    </div>
                    <p class="mb-4 text-neutral-500">Users registered</p>
                </div>
                <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block mb-3">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$projects}}</h5>
                    </div>
                    <p class="mb-4 text-neutral-500">Projects registered</p>
                </div>
                <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block mb-3">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$active_projects}}
                        </h5>
                    </div>
                    <p class="mb-4 text-neutral-500">Active projects</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>