<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockFoodController;
use App\Http\Controllers\ShoppingListController;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\ConfirmablePasswordController;
use App\Http\Controllers\User\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\User\Auth\EmailVerificationPromptController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\Auth\VerifyEmailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.welcome');
})->name('welcome');

Route::middleware('auth:users')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::get('/stocks/create', [StockController::class, 'showCreateForm'])->name('stocks.create');
    Route::post('/stocks/create', [StockController::class, 'create']);

    Route::middleware('can:view,stock')->group(function() {

        Route::get('/stocks/{stock}/stock_foods', [StockFoodController::class, 'index'])->name('stock_foods.index');

        Route::get('/stocks/{stock}/stock_foods/create',[StockFoodController::class, 'showCreateForm'])->name('stock_foods.create');
        Route::post('/stocks/{stock}/stock_foods/create',[StockFoodController::class, 'create']);

        Route::get('/stocks/{stock}/stock_foods/{stock_food}/edit',[StockFoodController::class, 'showEditForm'])->name('stock_foods.edit');
        Route::post('/stocks/{stock}/stock_foods/{stock_food}/edit',[StockFoodController::class, 'edit']);

        Route::delete('/stocks/{stock}/stock_foods/{stock_food}', [StockFoodController::class, 'destroy'])->name('stock_foods.destroy');

        Route::get('/stocks/{stock}/stock_foods/gacha', [StockFoodController::class, 'gacha'])->name('stock_foods.gacha');

    });

    Route::get('/shopping_lists', [ShoppingListController::class, 'index'])->name('shopping_lists.index');

    Route::get('/shopping_lists/create',[ShoppingListController::class, 'showCreateForm'])->name('shopping_lists.create');
    Route::post('/shopping_lists/create',[ShoppingListController::class, 'create']);

    Route::get('/shopping_lists/edit/{shopping_list}', [ShoppingListController::class, 'showEditForm'])->name('shopping_lists.edit');
    Route::post('/shopping_lists/edit/{shopping_list}', [ShoppingListController::class, 'edit']);

    Route::delete('/shopping_lists/{shopping_list}', [ShoppingListController::class, 'destroy'])->name('shopping_lists.destroy');

});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:users')
    ->name('logout');