<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResources([
    'users' => 'API\UserApiController'
]);

Route::get('/profiles', 'API\UserApiController@profiles')->name('api.profiles');
Route::get('/profile/{id}', 'API\UserApiController@profileById')->name('api.profile_id');