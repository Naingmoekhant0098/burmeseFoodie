<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\cuisineController;
use App\Http\Controllers\ingredientController;
use App\Http\Controllers\mediaController;
use App\Http\Controllers\recipesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;


Route::prefix('auth')->group(function(){
    Route::post('/sendOtp' , [AuthController::class,'sendOtp']);
    Route::post('/verifyOtp' , [AuthController::class,'verifyOtp']);

});
Route::prefix('v1')->group(function(){
    Route::apiResource('recipes',recipesController::class);
    Route::get('/popular',[recipesController::class , 'popular']);
    Route::apiResource('categories',categoryController::class);
    Route::apiResource('cuisines',cuisineController::class);
    Route::apiResource('ingredients',ingredientController::class);
    Route::apiResource('media',mediaController::class);

})
?>
