<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Shops;

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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    Route::get('/',function (Request $request) {
        return reponse()->json(['message' , 'lol']);
    });
    Route::post('login', [AuthController::class , 'login'])->name('login.api');
    Route::post('register', [AuthController::class , 'register'])->name('register.api');
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class , 'logout'])->name('logout.api');
    // user details ...
    Route::get('user',[AuthController::class , 'user'])->name('user.api');
});


// show all available shops...
Route::get('shops' , function (Request $request)
{
    return Shops::all();
});