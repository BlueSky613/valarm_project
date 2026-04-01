<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\VirtualImage;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.wallet-users.index');
    }
    return redirect()->route('login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Quotes routes
    Route::get('/quotes', [AdminController::class, 'quotesIndex'])->name('quotes.index');
    Route::get('/quotes/create', [AdminController::class, 'quotesCreate'])->name('quotes.create');
    Route::post('/quotes', [AdminController::class, 'quotesStore'])->name('quotes.store');
    Route::get('/quotes/{quote}/edit', [AdminController::class, 'quotesEdit'])->name('quotes.edit');
    Route::put('/quotes/{quote}', [AdminController::class, 'quotesUpdate'])->name('quotes.update');
    Route::delete('/quotes/{quote}', [AdminController::class, 'quotesDestroy'])->name('quotes.destroy');
    
    // Horoscopes routes
    Route::get('/horoscopes', [AdminController::class, 'horoscopesIndex'])->name('horoscopes.index');
    Route::get('/horoscopes/create', [AdminController::class, 'horoscopesCreate'])->name('horoscopes.create');
    Route::post('/horoscopes', [AdminController::class, 'horoscopesStore'])->name('horoscopes.store');
    Route::get('/horoscopes/{horoscope}/edit', [AdminController::class, 'horoscopesEdit'])->name('horoscopes.edit');
    Route::put('/horoscopes/{horoscope}', [AdminController::class, 'horoscopesUpdate'])->name('horoscopes.update');
    Route::delete('/horoscopes/{horoscope}', [AdminController::class, 'horoscopesDestroy'])->name('horoscopes.destroy');
    
    // Voice Options routes
    Route::get('/voice-options', [AdminController::class, 'voiceOptionsIndex'])->name('voice-options.index');
    Route::get('/voice-options/create', [AdminController::class, 'voiceOptionsCreate'])->name('voice-options.create');
    Route::post('/voice-options', [AdminController::class, 'voiceOptionsStore'])->name('voice-options.store');
    Route::get('/voice-options/{voiceOption}/edit', [AdminController::class, 'voiceOptionsEdit'])->name('voice-options.edit');
    Route::put('/voice-options/{voiceOption}', [AdminController::class, 'voiceOptionsUpdate'])->name('voice-options.update');
    Route::delete('/voice-options/{voiceOption}', [AdminController::class, 'voiceOptionsDestroy'])->name('voice-options.destroy');
    
    // Virtual Images routes
    Route::get('/virtual-images', [AdminController::class, 'virtualImagesIndex'])->name('virtual-images.index');
    Route::get('/virtual-images/create', [AdminController::class, 'virtualImagesCreate'])->name('virtual-images.create');
    Route::post('/virtual-images', [AdminController::class, 'virtualImagesStore'])->name('virtual-images.store');
    Route::get('/virtual-images/{virtualImage}/edit', [AdminController::class, 'virtualImagesEdit'])->name('virtual-images.edit');
    Route::put('/virtual-images/{virtualImage}', [AdminController::class, 'virtualImagesUpdate'])->name('virtual-images.update');
    Route::delete('/virtual-images/{virtualImage}', [AdminController::class, 'virtualImagesDestroy'])->name('virtual-images.destroy');
});

// Profile routes
use App\Http\Controllers\ProfileController;
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Auth routes
Route::get('login', function() {
    $response = app(LoginController::class)->showLoginForm();
    // Add cache-control headers to prevent browser caching
    return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                   ->header('Pragma', 'no-cache')
                   ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
})->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/wallet-users', [AdminController::class, 'walletUsersIndex'])->name('wallet-users.index');
    Route::delete('/wallet-users/{walletUser}', [AdminController::class, 'walletUsersDestroy'])->name('wallet-users.destroy');
});

Route::get('api/v1/config', function () {
    $now = now();
    $quotes = Quote::where(function($q) use ($now) {
        $q->where('is_active', 1)
          ->where(function($q2) use ($now) {
              $q2->whereNull('scheduled_at')
                 ->orWhere('scheduled_at', '<=', $now);
          });
    })->pluck('content');

    $videos = VirtualImage::where('is_active', 1)->get();

    return response()->json([
        'motivationMessage' => $quotes,
        'videoPaths' => $videos
    ]);
});
