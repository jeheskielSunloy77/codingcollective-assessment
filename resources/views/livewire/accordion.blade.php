<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public $tabs;

    public function mount($tabs = null)
    {
        $this->tabs = $tabs;
    }
}; ?>

<div x-data="{ openTab: null }">
    @foreach ($tabs as $tab)
        <h2 @click="openTab = (openTab === {{ $loop->index }}? null : {{ $loop->index }})">
            <button type="button"
                class="{{ $loop->first ? 'rounded-t-md' : '' }} {{ $loop->last ? '' : 'border-b-0' }} flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-800 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-[#090909] gap-3"
                aria-expanded="true">
                <span class="flex items-center gap-2">
                    @if (isset($tab['icon']))
                        <svg class="w-3.5 h-3.5 {{ $tab['icon'] === 'check' ? 'text-green-500 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }} flex-shrink-0"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                    @endif
                    {{ $tab['title'] }}
                </span>
                <svg class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    x-bind:class="{ 'rotate-180': openTab !== {{ $loop->index }} }" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div x-show="openTab === {{ $loop->index }}" aria-labelledby="accordion-collapse-heading-1"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-800 dark:bg-[#090909]">
                <p class="text-gray-500 dark:text-gray-400">
                    {!! $tab['content'] !!}</p>
            </div>
        </div>
    @endforeach
</div>
