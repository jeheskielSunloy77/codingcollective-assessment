<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;

new #[Layout('components.layouts.guest')] #[Title('User Registration | Payment App')] class extends Component {
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $is_admin = false;

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'is_admin' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create(array_merge($validated, ['role' => $this->is_admin ? 'admin' : 'user'])))));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="space-y-4">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" placeholder="Enter your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="email" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" placeholder="Enter your password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="Confirm your password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <label for="is_admin" class="inline-flex items-center">
            <input wire:model="is_admin" id="is_admin" type="checkbox"
                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-black dark:focus:ring-white dark:focus:ring-offset-gray-800"
                name="is_admin">
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                Is Admin
            </span>
        </label>

        <x-primary-button class="inline-flex items-center justify-center w-full">
            {{ __('Register') }}
        </x-primary-button>
        <p class="text-sm text-center text-gray-600 dark:text-gray-400">
            Already have an account?
            <a class="underline hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}" wire:navigate>
                {{ __('login here!') }}
            </a>
        </p>
    </form>
</div>
