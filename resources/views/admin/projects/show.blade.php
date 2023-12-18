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

        <div
            class="my-4 space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent col-span-2">
            <div class="relative">
                <h2 class="text-xl">Updates</h2>
                <hr>
                <div class="md:flex items-center md:space-x-4 mb-3">
                    <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                            <svg class="fill-emerald-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                <path d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                            </svg>
                        </div>
                        <!-- Date -->
                        <time class="font-caveat font-medium text-xl text-indigo-500 md:w-28">Apr 7, 2024</time>
                    </div>
                    <!-- Title -->
                    <div class="text-slate-500 ml-14"><span class="text-slate-900 font-bold">Mark Mikrol</span> opened
                        the
                        request</div>
                </div>
                <!-- Card -->
                <div class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">Various
                    versions
                    have evolved over the years, sometimes by accident, sometimes on purpose injected humour and the
                    like.</div>
            </div>

            <!-- Item #2 -->
            <div class="relative">
                <div class="md:flex items-center md:space-x-4 mb-3">
                    <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                <path class="fill-slate-300"
                                    d="M14.853 6.861C14.124 10.348 10.66 13 6.5 13c-.102 0-.201-.016-.302-.019C7.233 13.618 8.557 14 10 14c.51 0 1.003-.053 1.476-.143L14.2 15.9a.499.499 0 0 0 .8-.4v-3.515c.631-.712 1-1.566 1-2.485 0-.987-.429-1.897-1.147-2.639Z" />
                                <path class="fill-slate-500"
                                    d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V11.5a.5.5 0 0 0 .8.4l1.915-1.436c.845.34 1.787.536 2.785.536 3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0Z" />
                            </svg>
                        </div>
                        <!-- Date -->
                        <time class="font-caveat font-medium text-xl text-indigo-500 md:w-28">Apr 7, 2024</time>
                    </div>
                    <!-- Title -->
                    <div class="text-slate-500 ml-14"><span class="text-slate-900 font-bold">John Mirkovic</span>
                        commented the
                        request</div>
                </div>
                <!-- Card -->
                <div class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">If you
                    are going
                    to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                    middle
                    of text.</div>
            </div>

            <!-- Item #3 -->
            <div class="relative">
                <div class="md:flex items-center md:space-x-4 mb-3">
                    <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                <path class="fill-slate-300"
                                    d="M14.853 6.861C14.124 10.348 10.66 13 6.5 13c-.102 0-.201-.016-.302-.019C7.233 13.618 8.557 14 10 14c.51 0 1.003-.053 1.476-.143L14.2 15.9a.499.499 0 0 0 .8-.4v-3.515c.631-.712 1-1.566 1-2.485 0-.987-.429-1.897-1.147-2.639Z" />
                                <path class="fill-slate-500"
                                    d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V11.5a.5.5 0 0 0 .8.4l1.915-1.436c.845.34 1.787.536 2.785.536 3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0Z" />
                            </svg>
                        </div>
                        <!-- Date -->
                        <time class="font-caveat font-medium text-xl text-indigo-500 md:w-28">Apr 8, 2024</time>
                    </div>
                    <!-- Title -->
                    <div class="text-slate-500 ml-14"><span class="text-slate-900 font-bold">Vlad Patterson</span>
                        commented the
                        request</div>
                </div>
                <!-- Card -->
                <div class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">Letraset
                    sheets
                    containing passages, and more recently with desktop publishing software like Aldus PageMaker
                    including
                    versions of Ipsum.</div>
            </div>

            <!-- Item #4 -->
            <div class="relative">
                <div class="md:flex items-center md:space-x-4 mb-3">
                    <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                <path class="fill-slate-300"
                                    d="M14.853 6.861C14.124 10.348 10.66 13 6.5 13c-.102 0-.201-.016-.302-.019C7.233 13.618 8.557 14 10 14c.51 0 1.003-.053 1.476-.143L14.2 15.9a.499.499 0 0 0 .8-.4v-3.515c.631-.712 1-1.566 1-2.485 0-.987-.429-1.897-1.147-2.639Z" />
                                <path class="fill-slate-500"
                                    d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V11.5a.5.5 0 0 0 .8.4l1.915-1.436c.845.34 1.787.536 2.785.536 3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0Z" />
                            </svg>
                        </div>
                        <!-- Date -->
                        <time class="font-caveat font-medium text-xl text-indigo-500 md:w-28">Apr 8, 2024</time>
                    </div>
                    <!-- Title -->
                    <div class="text-slate-500 ml-14"><span class="text-slate-900 font-bold">Mila Capentino</span>
                        commented the
                        request</div>
                </div>
                <!-- Card -->
                <div class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">It is a
                    long
                    established fact that a reader will be distracted by the readable content of a page when looking at
                    its
                    layout.</div>
            </div>

            <!-- Item #5 -->
            <div class="relative">
                <div class="md:flex items-center md:space-x-4 mb-3">
                    <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                            <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                <path d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                            </svg>
                        </div>
                        <!-- Date -->
                        <time class="font-caveat font-medium text-xl text-indigo-500 md:w-28">Apr 9, 2024</time>
                    </div>
                    <!-- Title -->
                    <div class="text-slate-500 ml-14"><span class="text-slate-900 font-bold">Mark Mikrol</span> closed
                        the
                        request</div>
                </div>
                <!-- Card -->
                <div class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">If you
                    are going
                    to use a passage of Lorem Ipsum!</div>
            </div>
        </div>

    </div>
</x-app-layout>