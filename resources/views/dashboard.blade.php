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
                <x-primary-link href="{{route('admin.users.index')}}">
                    <span>Manage users &rarr;</span>
                </x-primary-link>
                <x-primary-link href="{{route('admin.plans.index')}}">
                    <span>Manage plans &rarr;</span>
                </x-primary-link>
                <x-primary-link href="{{route('admin.projects.index')}}">
                    <span>Manage projects &rarr;</span>
                </x-primary-link>
                @else

                <x-primary-link href="{{route('projects.index')}}">
                    <span>View projects &rarr;</span>
                </x-primary-link>
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
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$plans}}
                        </h5>
                    </div>
                    <p class="mb-4 text-neutral-500">Plans created</p>
                </div>
                <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block mb-3">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$projects}}</h5>
                    </div>
                    <p class="mb-4 text-neutral-500">Projects registered</p>
                </div>

            </div>
            @endif
        </div>
    </div>
</x-app-layout>