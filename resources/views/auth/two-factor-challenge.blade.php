<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your 2FA code before continuing.') }}
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <!-- code -->
        <div>
            <x-input-label for="code" :value="__('2FA Code')" />

            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required
                autocomplete="current-code" />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>