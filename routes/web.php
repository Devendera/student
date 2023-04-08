<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Patient\PatientController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

#ADMIN ROUTES
Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware' => ['auth','admin']], function () {
    
	#DASHBOARD
	Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
	
    #LOGOUT
	Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
	
	#PROFILE
	Route::get('/profile', [AdminController::class, 'profile'])->name('dashboard.profile');
	Route::post('/update_profile', [AdminController::class, 'update_profile'])->name('dashboard.update_profile');
	
    #USERS
	Route::get('/users', [AdminController::class, 'all_users'])->name('dashboard.all_users');
	Route::get('/add-user', [AdminController::class, 'add_user'])->name('dashboard.add_user');
	Route::post('/add_user_action', [AdminController::class, 'add_user_action'])->name('dashboard.add_user_action');
	Route::get('/user/edit/{id}', [AdminController::class, 'edit_user'])->name('dashboard.edit_user');
	Route::post('/user/edit_user_action', [AdminController::class, 'edit_user_action'])->name('dashboard.edit_user_action');
	Route::get('/user/delete/{id}', [AdminController::class, 'delete_user'])->name('dashboard.delete_user');
});

#FRONTEND ROUTES

	Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::post('/add_user_action', [App\Http\Controllers\HomeController::class, 'add_user_action'])->name('add_user_action');
	Route::post('/signIn', [App\Http\Controllers\HomeController::class, 'signIn'])->name('signIn');

	Route::get('/user-verify/{id}', [App\Http\Controllers\HomeController::class, 'user_verify'])->name('user_verify');
	


