<?php

use App\Models\Union;
use App\Models\Zilla;
use App\Livewire\ThanaIndex;
use App\Livewire\ZillaIndex;
use App\Livewire\UnionIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\CrimeIndex;
use App\Livewire\Dashboard;
use App\Livewire\Stat;

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

Route::get('/', [HomeController::class, 'ho
// Adminme'])->name("index");
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/stats', Stat::class)->middleware(['auth','verified'])->name('stat');
    Route::get('/crimes', CrimeIndex::class)->middleware(['auth','verified'])->name('crime.index');
    Route::get('/zilla', ZillaIndex::class)->middleware(['auth','verified'])->name('zilla.index');
    Route::get('/ps', ThanaIndex::class)->middleware(['auth','verified'])->name('ps.index');
    Route::get('/unions', UnionIndex::class)->middleware(['auth','verified'])->name('union.index');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
