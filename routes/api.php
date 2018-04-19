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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'UserController@index');

Route::get('sync-users', 'UserController@saveUsersToElearning');

Route::get('organizations', 'OrganizationController@index');

Route::get('sync-organizations', 'OrganizationController@saveOrganizationsToElearning');

Route::post('course/insert-course-from-elearning', 'CourseController@insertCourseFromElearning');


