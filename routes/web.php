<?php

use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks
 */
Route::get('/', function () {
    //
});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    //
});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    //
});

Route::get('/', function () {
    return view('tasks');
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});

Route::post('/task/all', function (Request $request) {
    Task::truncate();

    return redirect('/');
});

Route::post('/task/done', function (Request $request) {
    Task::patch();

    return redirect('/');
});