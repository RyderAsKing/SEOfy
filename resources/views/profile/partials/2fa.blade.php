<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('2 Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Set up Two-Factor Authentication (2FA) now. Shield your personal information with an extra layer of defense.
        </p>

        @if (auth()->user()->two_factor_secret)
        <p class="mt-1 text-sm text-gray-600">
            {{ __('You have enabled Two-Factor Authentication.') }}
        </p>
        @else
        <p class="mt-1 text-sm text-gray-600">
            {{ __('You have not enabled Two-Factor Authentication.') }}
        </p>
        @endif
    </header>

    @if(!auth()->user()->two_factor_secret)
    <form action="{{route('two-factor.enable')}}" method="POST">
        @csrf
        <x-primary-button type="submit">{{ __('Setup 2FA') }}</x-primary-button>
    </form>
    @else
    <form action="{{route('two-factor.disable')}}" method="POST">
        @csrf
        @method('DELETE')

        @if(!auth()->user()->two_factor_confirmed_at)
        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'show-qr')">{{ __('Confirm 2FA OTP') }}
        </x-primary-button>
        @endif
        <x-danger-button type="submit">{{ __('Disable 2FA') }}</x-danger-button>
    </form>
    @endif

    @if(!auth()->user()->two_factor_confirmed_at && auth()->user()->two_factor_secret)
    <x-modal name="show-qr" show focusable>
        <form method="post" action="{{ route('two-factor.confirm') }}" class="p-6">
            @csrf

            <!-- Your existing modal content -->

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('2FA setup') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Open your authenticator app, like Google Authenticator, and use the app's scanning feature to scan the
                provided QR code. Once scanned, your app will generate time-based codes for added security.
            </p>

            <div class="mt-6 flex justify-center">
                {!! auth()->user()->twoFactorQrCodeSvg() !!}
            </div>

            <div class="mt-6">
                <x-input-label for="code" value="{{ __('2FA OTP') }}" class="sr-only" />
                <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                    placeholder="{{ __('Confirm 2FA OTP') }}" />

                @if ($errors->confirmTwoFactorAuthentication->any())
                @foreach ($errors->confirmTwoFactorAuthentication->all() as $error)
                <x-input-error :messages="$error" class="mt-2" />
                @endforeach
                @endif
            </div>

            <div class="mt-6 flex justify-end flex flex gap-2">
                <x-primary-button x-on:click="$dispatch('close')">
                    {{ __('Confirm 2FA') }}
                </x-primary-button>
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
    @endif
</section>