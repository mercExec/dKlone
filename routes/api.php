<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ServerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/createServer', [ServerController::class, 'createServer']);
    Route::post('/joinServer/{server}', [ServerController::class, 'joinServer']);
    Route::get('/getServers', [ServerController::class, 'getUserServers']);
    Route::get('/getServer/{server}', [ServerController::class, 'getServer']);

    Route::post('/createChannel/{server}', [ChannelController::class, 'createChannel']);
    Route::get('/getChannel/{channel}', [ChannelController::class, 'getChannel']);
    Route::get('/getMessages/{channel}', [ChannelController::class, 'getMessages']);
    Route::post('/sendMessage/{channel}', [ChannelController::class, 'sendMessage']);

    Route::post('/addFriend/{username}', [FriendshipController::class, 'addFriend']);
    Route::post('/acceptFriendRequest/{sender}', [FriendshipController::class, 'acceptRequest']);
    Route::post('/removeFriend/{user}', [FriendshipController::class, 'removeFriend']);
    Route::post('/removeFriendRequest/{friendshipRequest}', [FriendshipController::class, 'removeRequest']);
    Route::get('/getFriends', [FriendshipController::class, 'getFriends']);
    Route::get('/getPendingFriendships', [FriendshipController::class, 'getPendingFriendships']);

    Route::post('/blockUser/{user}', [FriendshipController::class, 'block']);
    Route::post('/unblockUser/{user}', [FriendshipController::class, 'unblock']);
    Route::get('/getBlockedUsers', [FriendshipController::class, 'getBlockedUsers']);

    Route::get('/getConversations', [ConversationController::class, 'getConversations']);
    Route::get('/getNotifications', [ConversationController::class, 'getNotifications']);
    Route::get('/checkConversationExists/{recipientId}', [ConversationController::class, 'checkConversationExists']);
    Route::get('/getConversation/{conversation}', [ConversationController::class, 'getConversation']);
    Route::post('/deleteConversation/{conversation}', [ConversationController::class, 'deleteConversation']);
    Route::get('/getDirectMessages/{conversation}', [ConversationController::class, 'getMessages']);
    Route::post('/sendDirectMessage/{recipientId}/{conversation?}', [ConversationController::class, 'sendMessage']);
    Route::post('/createNotification/{sender}/{recipient}/{conversation}', [ConversationController::class, 'createNotification']);

    Route::get('/getPublicServers', [ServerController::class, 'getPublicServers']);
});