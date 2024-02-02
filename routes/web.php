<?php

use App\Http\Controllers\TransactionController;
use App\Http\Middleware\UsernameOnAuthHeader;
use App\Livewire\Dashboard;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified', UsernameOnAuthHeader::class])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');

    Route::resource('transactions', TransactionController::class);
});

require __DIR__ . '/auth.php';
