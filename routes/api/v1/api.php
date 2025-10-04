

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Quote;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Return all motivational quotes as {motivationMessage: [ ... ]}
// Route::get('config', function () {
//     // $quotes = Quote::where('is_active', true)->pluck('content');
//     // return response()->json([
//     //     'motivationMessage' => $quotes
//     // ]);
//     return response() -> json([1,1]);
// });