<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [UserController::class, 'login'])->middleware('verifyEmail');
Route::post('/register', [UserController::class, 'store']);
Route::middleware(['api' , 'auth:sanctum', 'verifyEmail', 'verified'])->group(function () {
    Route::post('/user', [UserController::class, 'index']);
});
//this.$store.dispatch("deleteUser", user.id)
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
