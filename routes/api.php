<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'It\'s working',
    ]);
});

Route::get('posts', [ PostController::class, 'index' ]);
Route::get('posts/{post}', [ PostController::class, 'show' ]);
Route::post('posts', [ PostController::class, 'store' ]);
Route::put('posts/{post}', [ PostController::class, 'update' ]);
Route::delete('posts/{post}', [ PostController::class, 'destroy' ]);
