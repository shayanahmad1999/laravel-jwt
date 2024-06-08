<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomAuthUserRoleController;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/admin', function (Request $request) {
    return User::all();
})->middleware('auth:sanctum', 'is_admin');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('custom/logout', [CustomAuthUserRoleController::class, 'logout']);
});


//::::::::::: for custom create login :::::::::::::://
Route::post('custom/register', [CustomAuthUserRoleController::class, 'register']);
Route::post('custom/login', [CustomAuthUserRoleController::class, 'login']);
//::::::::::: for custom create login :::::::::::::://


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('forgot-password', [ForgotPassword::class, 'setResetLinkEmail']);
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::middleware(['auth:api'])->group(function(){

    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('posts')->group(function() {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::get('/{post}', [PostController::class, 'show']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
        
        // Route::apiResource('/', PostController::class);
    });

});
