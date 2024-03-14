<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Creating a new project
                    </h5>
                </div>
                <p class="mb-4 text-neutral-500">Creating a new project by providing a name, description and the plan
                </p>

                <form method="post" action="{{route('admin.projects.store')}}">
                    @csrf

                    <div class="form-inputs my-2 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <x-input-label for="name" value="Name" />
                            <x-text-input name="name" label="name" placeholder="Eg. John Doe" required />
                            @error('name')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="description" value="Description" />
                            <x-text-input name="description" label="description"
                                placeholder="Eg. This project is about..." required />
                            @error('description')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="website" value="Website" />
                            <x-text-input name="url" label="website" placeholder="Eg. google.com" required />
                            @error('url')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        @if($plans->isEmpty())
                        <div class="flex flex-col">
                            <x-input-label for="plan" value="Plan" />
                            <p class="text-neutral-500">No plans found. Please create a plan first.</p>
                        </div>
                        @endif

                        <div class="form-group">
                            <x-input-label for="plan" value="Plan" />
                            <div x-data="{
                            radioGroupSelectedValue: null,
                            radioGroupOptions: [
                                @foreach($plans as $plan)
                                {
                                    title: '{{$plan->name}}',
                                    description: '{{$plan->description}}',
                                    value: '{{$plan->id}}'
                                },
                                @endforeach
                            ]
                        }" class="space-y-3">
                                <template x-for="(option, index) in radioGroupOptions" :key="index">
                                    <label @click="radioGroupSelectedValue=option.value"
                                        class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                                        <input type="radio" name="plan_id" :value="option.value"
                                            class="text-gray-900 translate-y-px focus:ring-gray-700" />
                                        <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                                            <span x-text="option.title" class="font-semibold"></span>
                                            <span x-text="option.description" class="text-sm opacity-50"></span>
                                        </span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <div class="form-group">
                            <x-input-label for="user_id" value="User" />
                            <select name="user_id" id="user_id"
                                class="form-control select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} | {{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <p class="text-md">Integration for <a href="https://enhance.com/" class="text-blue-500"
                                target="_blank">enhance
                                control panel</a> (leave empty if not setup)</p>

                        <div class="form-group">
                            <div class="flex flex-col">
                                <x-input-label for="org_id" value="Org ID" />
                                <x-text-input type="text" name="org_id" required
                                    placeholder="eg. ba059e14-b5e3-4739-b4dc-f6bd4c7c3cc3">
                                </x-text-input>
                            </div>
                            @error('org_id')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        {{-- website id --}}

                        <div class="form-group">
                            <div class="flex flex-col">
                                <x-input-label for="website_id" value="Website ID" />
                                <x-text-input type="text" name="website_id" required
                                    placeholder="eg. 51f9ffbd-f789-4d7f-953d-9c45a5287f45">
                                </x-text-input>
                            </div>
                            @error('website_id')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>


                        <x-primary-button type="submit" class="max-w-fit">
                            <span>Create project &rarr;</span>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</x-app-layout>
