<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\SuperAdmin\RoleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
});

Route::view('/admin-layout','layouts.admin-layout')->name('admin-layout');
Route::view('/layout-dashboard','layouts.dashboard')->name('layout-dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    })->name('dashboard');
});

Route::view('/log','login')->name('log');

Route::middleware(['auth:sanctum','auth:web','role:Super-Admin', config('jetstream.auth_session'), 'verified'])->name('super.admin.')
    ->prefix('super-admin/')->group(function(){
        Route::resource('/roles',RoleController::class);
        Route::resource('/permissions',PermissionController::class);
        Route::get('/destroy/role/{role}',[RoleController::class,'destroy'])->name('destroy.role');
        Route::post('/roles/give-permission/{role}',[RoleController::class,'givePermission'])->name('roles.give-permission');
        Route::get('/roles/permissions/{role}',[RoleController::class,'permissions'])->name('roles.permissions');
        Route::get('/destroy/permission/{permission}',[PermissionController::class,'destroy'])->name('destroy.permission');
        Route::post('/permissions/async-role/{permission}',[PermissionController::class,'asyncRole'])->name('permissions.async-role');
        Route::get('/permissions/roles/{permission}',[PermissionController::class,'roles'])->name('permissions.role');

    });

Route::middleware(['auth:sanctum','auth:web', config('jetstream.auth_session'),'verified'])->group(function(){
        Route::resource('/articles',ArticleController::class);
        Route::get('/articles/delete/{article}',[ArticleController::class,'destroy'])->name('articles.delete');
    });
