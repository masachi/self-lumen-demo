<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'user'], function($app){
    $app->post('profile', 'UserController@getProfile');
    $app->post('device', 'UserController@insertDevice');
    $app->post('timeoff', 'UserController@addTimeOff');
});

$app->group(['prefix' => 'news'], function ($app){
    $app->get('/', 'NotificationController@getNotification');
});

$app->group(['prefix' => 'calendar'], function ($app){
    $app->post('date', 'CalendarController@getExamDate');
    $app->post('all', 'CalendarController@getAllDate');
});

$app->group(['prefix' => 'course'], function ($app){
    $app->post('list', 'CourseController@getCourseList');
    $app->post('info', 'CourseController@getCourseInfo');
    $app->post('comments', 'CourseController@updateComments');
//    $app->post('push', 'CourseController@push');
});
