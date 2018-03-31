<?php

Auth::loginUsingId(1);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use \App\Task;

Route::get('/', function () {
    $tasks = Task::latest()->get();
    return view('welcome', compact('tasks'));
});

Route::post('/tasks', function () {
    Auth::user()->notify(new App\Notifications\TaskCreated);

    Task::create(request(['body']));
    return redirect('/');
});

Route::delete('users/{user}/notifications', function(App\User $user) {
    $user->unreadNotifications->map(function($notification) {
        $notification->markAsRead();
    });

    return back();
});