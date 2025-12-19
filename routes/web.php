<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Mon Espace (Personal Dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Influenceurs List
    Route::get('/influencers', function () {
        $influencers = User::query()
            ->where('role', \App\Enums\UserRole::Influencer)
            ->with(['influencerProfile'])
            ->inRandomOrder()
            ->get();

        return view('influencers', ['influencers' => $influencers]);
    })->name('influencers.index');

    // Classement (Ranking)
    Route::get('/ranking', function () {
        return view('ranking.index');
    })->name('ranking.index');

    // Entreprises List
    Route::get('/enterprises', function () {
        $enterprises = User::query()
            ->where('role', \App\Enums\UserRole::Enterprise)
            ->with(['enterpriseProfile'])
            ->inRandomOrder()
            ->get();

        return view('enterprises.index', ['enterprises' => $enterprises]);
    })->name('enterprises.index');

    // Panel Routes
    Route::get('/campaigns', function () {
        return view('campaigns.index');
    })->name('campaigns.index');

    Route::get('/portfolio', function () {
        return view('portfolio.index');
    })->name('portfolio.index');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');

    Route::get('/discussions', function () {
        return view('discussions.index');
    })->name('discussions.index');

    Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/u/{user}', [ProfileController::class, 'publicShow'])->name('profile.public');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
