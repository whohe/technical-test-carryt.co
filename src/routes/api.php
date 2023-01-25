<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharactersController;

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

Route::get('characters', [CharactersController::class, 'show']);
Route::post('characters', [CharactersController::class, 'create']);
Route::get('characters/{id}', [CharactersController::class, 'read']);
Route::put('characters/{id}', [CharactersController::class, 'update']);
Route::delete('characters/{id}', [CharactersController::class, 'delete']);
