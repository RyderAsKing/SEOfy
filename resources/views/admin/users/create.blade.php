<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Creating a new user</h5>
                </div>
                <p class="mb-4 text-neutral-500">Creating a new user by providing a email and password</p>

                <form method="post" action="{{route('admin.users.store')}}">
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
                            <x-input-label for="email" value="Email" />
                            <x-text-input name="email" label="Email" type="email" placeholder="Eg. someone@example.com"
                                required />
                            @error('email')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="password" value="Password" />
                            <x-text-input type="password" name="password" label="password"
                                placeholder="Eg. VeryStrongPassword12#$" required autocomplete="new-password" />
                            @error('password')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="items-center">
                            <input id="checkbox-id" type="checkbox" name="is_admin"
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900">
                            <label for="checkbox-id" class="ml-2 text-sm font-medium text-gray-900">Is admin?</label>
                        </div>

                        <x-primary-button type="submit" class="max-w-fit">
                            <span>Create user &rarr;</span>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>