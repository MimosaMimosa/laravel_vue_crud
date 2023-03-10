<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('v1.')->group(function () {
    Route::post('/companies', [CompanyController::class, 'store'])->name('company.create');
    Route::get('/companies', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('company.show');
    Route::post('/companies/{id}', [CompanyController::class, 'update'])->name('company.update');
});
