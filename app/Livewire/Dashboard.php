<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard | Payment App')]

class Dashboard extends Component
{
    public $transactions = [];
    public $balance = 0;
    public $search = '';

    public $depositAmount;
    public $withdrawAmount;

    public function mount()
    {
        if (request()->has('q')) {
            $this->search = request('q');

            $this->transactions =
                request()->user()->transactions()
                ->where('type', 'like', '%' . $this->search . '%')
                ->orWhere('amount', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->transactions =
                Cache::remember('transaction:user:' . request()->user()->id, 60, function () {
                    return request()->user()->transactions()->get()->sortByDesc('created_at');
                });
        }

        $deposits = $this->transactions->where('type', 'deposit')->sum('amount');
        $withdrawals = $this->transactions->where('type', 'withdraw')->sum('amount');

        $this->balance = $deposits - $withdrawals;
    }

    public function createTransaction(string $type)
    {
        $this->authorize('create', Transaction::class);

        if ($type !== 'deposit' && $type !== 'withdraw') {
            $this->addError('type', 'Invalid transaction type');
            return;
        }

        $typeField = $type . 'Amount';
        $isDeposit = $type === 'deposit';

        $this->validateOnly($typeField, [
            $typeField => 'required|numeric|min:1' . ($isDeposit ? '' : '|max:' .  $this->balance),
        ], [
            $typeField . '.min' => 'The amount must be at least Rp. 1.00!',
            $typeField . '.max' => 'The amount must not be greater than your balance!',
        ]);

        $userId = request()->user()->id;

        $transaction = Transaction::create([
            'user_id' => $userId,
            'amount' => $isDeposit ? $this->depositAmount : $this->withdrawAmount,
            'type' => $type,
        ]);

        Cache::put('transaction:' . $transaction->id, $transaction, 60);
        Cache::forget('transaction');
        Cache::forget('transaction:user:' . $userId);

        $this->mount();
        $this->reset([$typeField]);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        Cache::forget('transaction');
        Cache::forget('transaction:' . $transaction->id);
        Cache::forget('transaction:user:' . $transaction->user_id);

        $transaction->delete();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
