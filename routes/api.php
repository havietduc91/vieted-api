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

Route::middleware(['ipcheck'])->group(function () {
    Route::post('course/insert-course-from-elearning', 'CourseController@insertCourseFromElearning');

    Route::post('path/insert-path-from-elearning', 'PathController@insertPathFromElearning');

    Route::post('path-course/insert-path-courses-from-elearning', 'PathCourseController@insertPathCoursesFromElearning');

    Route::post('progress/insert-progress-from-elearning', 'ProgressController@insertProgressFromElearning');
});

Route::get('users', 'UserController@index');

Route::get('sync-users', 'UserController@saveUsersToElearning');

Route::get('organizations', 'OrganizationController@index');

Route::get('sync-organizations', 'OrganizationController@saveOrganizationsToElearning');



