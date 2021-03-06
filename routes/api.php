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
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'users' => 'API\UserController',
    'admin-settings' => 'API\SkillsController',
    'profile' => 'API\UserSkillsController'
]);


Route::group([
    'middleware' => 'auth'
], function() {
    Route::get('custom', 'API\ProfileController@show');
});
