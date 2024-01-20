<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BranchOfficeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CashierController;
use App\Http\Controllers\Api\DteController;
use App\Http\Controllers\Api\CollectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
});

Route::resource('branch_office', BranchOfficeController::class)->except(['create']);
Route::resource('user', UserController::class)->except(['create', 'edit']);
Route::resource('cashier', CashierController::class)->except(['create']);
Route::resource('dte', DteController::class);
Route::resource('collection', CollectionController::class);
Route::get('branch_office/all_data/get_select', 'App\Http\Controllers\Api\BranchOfficeController@get_select');
Route::get('dte/show/{branch_office_id}/{cashier_id}/{date}', 'App\Http\Controllers\Api\DteController@show');
Route::get('dte/download/{folio}', 'App\Http\Controllers\Api\DteController@download');