<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DmTextController;


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


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// DM機能
Route::get('/dm/create/',               [DmTextController::class, 'create'])->name('dm.create');
Route::post('/dm/form/create',          [DmTextController::class, 'form_create'])->name('dm.form.create');
Route::get('/dm/edit/{dm_id}/',         [DmTextController::class, 'edit'])->name('dm.edit');
Route::post('/dm/form/edit/{dm_id}/',   [DmTextController::class, 'form_edit'])->name('dm.form.edit');
Route::get('/dm/{user_id}/',            [DmTextController::class, 'index'])->name('dm.index');