<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Viewing Project') }}
            </h2>

            @if(auth()->user()->is_admin)
            <a href="{{route('admin.plans.edit', $project)}}"
                class="w-max inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                <span>Edit Project &rarr;</span>
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12 grid grid-cols-2 max-w-7xl mx-auto gap-2 sm:px-6 lg:px-8">

        <div class="flex flex-col gap-4">
            <div>
                <h1 class="text-xl mb-1">Project details</h1>
                <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block mb-3">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$project->name}}

                        </h5>
                    </div>
                    <span>Website: <a href="{{$project->url}}"
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{$project->url}}</a></span>
                    <p class="mb-4 text-neutral-500">{{$project->description}}</p>
                </div>
            </div>
            <div>
                <h1 class="text-xl mb-1">Current Status</h1>
                <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <h1>The current status of the project</h1>
                    @foreach($project->custom_fields as $field => $value)
                    <div class="flex justify-between">
                        <span class="text-neutral-500">{{$field}}</span>
                        <span class="text-neutral-900">{{$value}} /
                            {{intval($project->plan->features->$field)}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-xl mb-1">Plan details</h1>
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$project->plan->name}}
                    </h5>
                </div>
                <p class="mb-4 text-neutral-500">{{$project->plan->description}}</p>

                <h3>Features </h3>
                <div class="grid grid-cols-2 gap-2 my-2">
                    @foreach ($project->plan->features as $feature => $description)

                    <div class="max-w-sm bg-white border rounded-lg shadow-sm p-4 border-neutral-200/60">
                        <div class="block mb-3">
                            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$feature}}</h5>
                        </div>
                        <p class="mb-4 text-neutral-500">{{$description}}</p>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
        <div class="col-span-2 mt-4">
            <h2 class="text-xl">Updates</h2>
            @if($timelines->count() == 0)
            <div class="rounded-lg  mt-4">
                <h1 class="text-xl font-bold leading-none tracking-tight text-neutral-900">No updates yet</h1>
                <p class="mb-4 text-neutral-500">There are no updates yet, check back later.</p>
            </div>
            @endif
            <ol class="border-l border-neutral-300 ">
                @foreach ($timelines as $timeline)
                <li>
                    <div class="flex-start flex items-center pt-3">
                        <div class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-neutral-300 "></div>
                        <p class="text-sm text-neutral-500 ">
                            {{$timeline->created_at->format('d.m.Y')}}
                        </p>
                    </div>
                    <div class="mb-6 ml-4 mt-2">
                        <h4 class="mb-1.5 text-xl font-semibold">{{$timeline->title}}</h4>
                        <p class="mb-3 text-neutral-500 ">
                            {{$timeline->description}}
                        </p>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
        {{$timelines->links()}}
    </div>
</x-app-layout>