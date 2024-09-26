<?php

// routes/web.php

use App\Http\Controllers\ScreenshotUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/screenshot-urls', [ScreenshotUrlController::class, 'index'])->name('screenshot_urls.index');
Route::post('/screenshot-urls', [ScreenshotUrlController::class, 'store'])->name('screenshot_urls.store');
Route::delete('/screenshot-urls/{id}', [ScreenshotUrlController::class, 'destroy'])->name('screenshot_urls.destroy');
