<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/send_msg', 'TelegramController@send_msg');
Route::post('/send_msg', 'TelegramController@send_msg_post');

Route::get('/notify_chat', 'ChatController@chatup');

Route::post('/send_msg_to_group', 'TelegramController@send_msg_to_group');

Route::post('/unms_group_msg', 'TelegramController@unms_group_msg');

Route::post('/send_msg_decode', 'TelegramController@send_msg_decode');

Route::post('/send_html_msg_to_group', 'TelegramController@send_html_msg_to_group');
