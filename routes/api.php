<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MessageController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return $request->user();
});

Route::prefix('messages')->controller(MessageController::class)->name('api.message.')->group(function()
{
    Route::get('', 'index')->name('index');
    Route::get('{message}', 'show')->name('show');
    Route::post('','store')->name('store');
    Route::delete('{message}','destroy')->name('destroy');
});

require __DIR__.'/auth.php';
