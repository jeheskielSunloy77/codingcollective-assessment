<main class="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-6">
    <div class="flex flex-col md:grid md:grid-cols-2 gap-6">
        <div class="flex flex-col gap-6">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Deposit
                    </h3>
                </div>
                <div class="p-6">
                    <form wire:submit="createTransaction('deposit')" class="space-y-4">
                        <div class="space-y-2"><label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="deposit-amount">Amount</label><input
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                id="deposit-amount" placeholder="Enter deposit amount" type="number"
                                wire:model="depositAmount" min="1" step=".01" required>
                        </div>
                        @error('depositAmount')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        <button
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black text-white hover:bg-black/90 h-10 px-4 py-2 w-full"
                            type="submit">Submit Deposit</button>
                    </form>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Withdrawal
                    </h3>
                </div>
                <div class="p-6">
                    <form class="space-y-4" wire:submit="createTransaction('withdraw')">
                        <div class="space-y-2"><label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="withdraw-amount">Amount</label><input
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                id="withdraw-amount" placeholder="Enter withdraw amount" type="number"
                                wire:model="withdrawAmount" min="1" step=".01" required>
                        </div>
                        @error('withdrawAmount')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        <button
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black text-white hover:bg-black/90 h-10 px-4 py-2 w-full"
                            type="submit">Submit withdraw</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">
                        Rp. {{ number_format($balance, 2) }}
                    </h3>
                    <p class="text-sm font-medium leading-none text-muted-foreground">Current Balance</p>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">
                        Transaction History</h3>
                </div>
                <div class="p-6">
                    <form>
                        <div class="relative"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500 dark:text-gray-400">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg><input
                                class="h-10 rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full bg-white shadow-none appearance-none pl-8 dark:bg-gray-950"
                                placeholder="Search transaction" type="search" name="q"
                                value="{{ $search }}"></div>
                    </form>
                    <div class="relative w-full overflow-auto max-h-[500px]">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&amp;_tr]:border-b">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                        Type</th>
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                        Amount</th>
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                        Date</th>
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="[&amp;_tr:last-child]:border-0">
                                @foreach ($transactions as $transaction)
                                    <tr
                                        class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 capitalize">
                                            {{ $transaction->type }}
                                        </td>
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                            Rp. {{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                            {{ $transaction->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                            <button wire:click="deleteTransaction('{{ $transaction->id }}')"
                                                class="rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black text-white hover:bg-black/90 h-10 px-4 py-2 w-full">
                                                Delete
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
