<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home page
Route::get('/', function () {
    return Inertia::render('Home'); // Render the `Home.vue` component
});

// About page
Route::get('/about', function () {
    return Inertia::render('About'); // Render the `About.vue` component
});

// User profile page
Route::get('/user/{id}', function ($id) {
    return Inertia::render('User/Profile', [
        'userId' => $id, // Pass data to the Vue component
    ]);
});

Route::get('/teste/{search}',[ TestController::class, 'teste' ])->name('test.get');

Route::post('/post',[ TestController::class, 'testePost' ])->name('test.post');

Route::get('/users/get',[ TestController::class, 'GetUsers' ])->name('users.get');

Route::get('/screen1',[ TestController::class, 'renderScreen1' ])->name('render.screen1');

Route::get('/screen2',[ TestController::class, 'renderScreen2' ])->name('render.screen2');

Route::get('/screen3',[ TestController::class, 'renderScreen3' ])->name('render.screen3');

Route::get('/api/data/{search}',[ TestController::class, 'GetApiData' ])->name('get.api.data');

Route::get('/api/get/color',[ TestController::class, 'GetColorPositionRandom' ])->name('get.api.color');

Route::post('/api/set/color/{array}/{row}/{col}',[ TestController::class, 'SetColorPosition' ])->name('set.api.color');