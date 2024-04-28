<?php

use App\Models\Player;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $players = Player::limit(5)->orderBy('name')->get();
    return Inertia::render('Game', compact('players'));
});

Route::get('/players/create', function () {
    return Inertia::render('PlayerForm');
});
