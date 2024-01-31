<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

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

            $this->transactions = Transaction::with('user')
                ->where('type', 'like', '%' . $this->search . '%')
                ->orWhere('amount', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->transactions = Transaction::with('user')->get()->sortByDesc('created_at');
        }

        $deposits = $this->transactions->where('type', 'deposit')->sum('amount');
        $withdrawals = $this->transactions->where('type', 'withdraw')->sum('amount');

        $this->balance = $deposits - $withdrawals;
    }

    public function createTransaction(string $type)
    {
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

        Transaction::create([
            'user_id' => User::first()->id,
            'amount' => $isDeposit ? $this->depositAmount : $this->withdrawAmount,
            'type' => $type,
        ]);

        $this->mount();
        $this->reset([$typeField]);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $transaction->delete();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
