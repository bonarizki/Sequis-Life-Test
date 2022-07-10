<?php

use App\Http\Controllers\FriendController;
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

Route::post('friend',[FriendController::class,'store']);
Route::patch('friend/{type}',[FriendController::class,'update']);
Route::get('friend/request/{email}',[FriendController::class,'showRequest']);
Route::get('friend/list/{email}',[FriendController::class,'showFriend']);
Route::get('friend-same',[FriendController::class,'showSameFriend']);
Route::patch('friend-block',[FriendController::class,'blockFriend']);
