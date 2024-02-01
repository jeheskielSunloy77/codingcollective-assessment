<main class="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-6">
    <div class="flex flex-col md:grid md:grid-cols-2 gap-6">
        <div class="flex flex-col gap-6">
            <x-dashboard.card title="Deposit">
                <form wire:submit="createTransaction('deposit')" class="space-y-4">
                    <div class="space-y-2">
                        <x-input-label for="deposit-amount" value="{{ __('Amount') }}" />
                        <x-text-input wire:model="depositAmount" id="deposit-amount" type="number" min="1"
                            step=".01" placeholder="Enter deposit amount" required />
                        <x-input-error :messages="$errors->get('depositAmount')" />
                    </div>
                    <x-primary-button type="submit" class="w-full">
                        Submit Deposit
                    </x-primary-button>
                </form>
            </x-dashboard.card>
            <x-dashboard.card title="Withdrawal">
                <form class="space-y-4" wire:submit="createTransaction('withdraw')">
                    <div class="space-y-2">
                        <x-input-label for="withdraw-amount" value="{{ __('Amount') }}" />
                        <x-text-input wire:model="withdrawAmount" id="withdraw-amount" type="number" min="1"
                            step=".01" placeholder="Enter withdraw amount" required />
                        <x-input-error :messages="$errors->get('withdrawAmount')" />
                    </div>
                    <x-primary-button type="submit" class="w-full">
                        Submit withdraw
                    </x-primary-button>
                </form>
            </x-dashboard.card>
        </div>
        <div class="flex flex-col gap-6">
            <x-dashboard.card>
                <div class="flex flex-col space-y-1.5">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">
                        Rp. {{ number_format($balance, 2) }}
                    </h3>
                    <p class="text-sm font-medium leading-none text-muted-foreground">Current Balance</p>
                </div>
            </x-dashboard.card>
            <x-dashboard.card title="Transaction History">
                <form class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500 dark:text-gray-400">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    <x-text-input class="pl-8" placeholder="Search transaction" type="search" name="q"
                        value="{{ $search }}" />
                </form>
                <div class="relative w-full overflow-auto max-h-[500px]">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&amp;_tr]:border-b">
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                    Type</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                    Amount</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                    Date</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="[&amp;_tr:last-child]:border-0">
                            @foreach ($transactions as $transaction)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle capitalize">
                                        {{ $transaction->type }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        Rp. {{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        {{ $transaction->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        <x-primary-button wire:click="deleteTransaction('{{ $transaction->id }}')"
                                            class="w-full"
                                            wire:confirm="Are you sure you want to delete this transaction? This action is irreversible.">
                                            Delete
                                        </x-primary-button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-dashboard.card>
        </div>
    </div>
</main>
