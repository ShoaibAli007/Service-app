<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EmailController;
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



Auth::routes();

Route::prefix('admin')->middleware(['auth','web'])->group(function () {

    Route::get('/', [ServiceController::class, 'index'])->name('landing.page');
    Route::get('purchase-services', [ServiceController::class, 'getPurchaseService'])->name('get.purchase.service');
    Route::post('purchase-services', [ServiceController::class, 'purchaseService'])->name('purchase.service');
    Route::get('email-create', [EmailController::class, 'emailCreate'])->name('email.create');
    Route::get('inbox', [EmailController::class, 'getInbox'])->name('email.inbox');
    Route::get('sendbox', [EmailController::class, 'getSendBox'])->name('email.sendBox');
    Route::post('email', [EmailController::class, 'sendEmail'])->name('email.send');
});

