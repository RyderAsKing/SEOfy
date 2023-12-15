<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit an existing user') }}
            </h2>

            <form action="{{route('admin.users.destroy', $user)}}" method="POST">
                @csrf
                @method('DELETE')

                <x-secondary-button type="submit" class="max-w-fit">
                    <span>Delete X</span>
                </x-secondary-button>
            </form>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Editing a user</h5>
                </div>
                <p class="mb-4 text-neutral-500">Leave the fields unchanged if you dont want to update</p>

                <form method="post" action="{{route('admin.users.update', $user)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-inputs my-2 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <x-input-label for="name" value="Name" />
                            <x-text-input name="name" label="name" placeholder="Eg. John Doe" required value="{{$user->
                                name}}" />
                            @error('name')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="email" value="Email" />
                            <x-text-input name="email" label="Email" type="email" placeholder="Eg. someone@example.com"
                                value="{{$user->email}}" required />
                            @error('email')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="password" value="Password" />
                            <x-text-input type="password" name="password" label="password"
                                placeholder="Eg. VeryStrongPassword12#$" autocomplete="new-password" />
                            @error('password')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex gap-2">
                            <x-primary-button type="submit" class="max-w-fit">
                                <span>Edit user &rarr;</span>
                            </x-primary-button>

                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>