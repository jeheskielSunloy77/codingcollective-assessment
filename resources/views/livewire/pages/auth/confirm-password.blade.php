<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;

new #[Layout('components.layouts.guest')] #[Title('Password Confirmation | Payment App')] class extends Component {
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (
            !Auth::guard('web')->validate([
                'email' => Auth::user()->email,
                'password' => $this->password,
            ])
        ) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form wire:submit="confirmPassword" class="space-y-4">
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="current-password" placeholder="Enter your password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Confirm
        </x-primary-button>
    </form>
</div>
