<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('change.password.store') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="current_password" :value="__('Current Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="current_password"
                                required autocomplete="current-password" />
            </div>

            <!-- New Password -->
            <div class="mt-4">
                <x-label for="new_password" :value="__('New Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="new_password"
                                required autocomplete="current-password" />
            </div>

             <!-- New Password Confirm -->
             <div class="mt-4">
                <x-label for="confirm_password" :value="__('Confirm Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="new_confirm_password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-3">
                    {{ __('Change Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>