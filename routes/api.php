<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;

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
Route::post('/apipartner',[PartnerController::class,'store']);
Route::get('/apipartner',[PartnerController::class,'index']);
Route::get('/apipartner/{id}',[PartnerController::class,'show']);
Route::put('/apipartner/{id}',[PartnerController::class,'update']);
Route::delete('/apipartner/{id}',[PartnerController::class,'destroy']);
// Route::resource('apipartner',PartnerController::class);