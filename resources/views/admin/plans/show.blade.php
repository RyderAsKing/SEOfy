<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$plan->name}}</h5>
                </div>
                <p class="mb-4 text-neutral-500">{{$plan->description}}</p>


                <h3>Features </h3>
                <div class="grid grid-cols-4 gap-2 my-2">
                    @foreach ($plan->features as $feature => $description)

                    <div class="max-w-sm bg-white border rounded-lg shadow-sm p-4 border-neutral-200/60">
                        <div class="block mb-3">
                            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$feature}}</h5>
                        </div>
                        <p class="mb-4 text-neutral-500">{{$description}}</p>

                    </div>
                    @endforeach
                </div>


                @if(auth()->user()->is_admin)
                <x-primary-link href="{{route('admin.plans.edit', $plan)}}"
                    class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                    <span>Edit plan &rarr;</span>
                </x-primary-link>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>