<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::controller(FooController::class)->group(function () {
//     Route::get('foo', 'index')->name('foo.index');
//     Route::post('foo', 'store')->name('foo.store');
//     Route::get('foo/create', 'create')->name('foo.create');
//     Route::get('foo/{foo}', 'show')->name('foo.show');
//     Route::post('foo/{foo}', 'update')->name('foo.update');
//     Route::delete('foo/{foo}', 'destroy')->name('foo.destroy');
//     Route::get('foo/{foo}/edit', 'edit')->name('foo.edit');
// });

if (App::environment('local')) {
    Route::get('/loginas/{email}', function ($email) {
        $user = \App\Models\User::where('email', 'like', '%' . $email . '%')->first();
        Auth::loginUsingId($user->id);
        return redirect()->route('home')->with('success', "Logged in as $user->email");
    });
}

Route::middleware(['web'])->group(function () {
    Route::group(['namespace' => 'Tabler'], function () {
        Auth::routes();
    });
});

Route::middleware(['web'])->controller(Tabler\App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('home', 'index')->name('home');
});

Route::middleware(['web', 'auth'])->name('tabler.admin.')->prefix('admin/')->controller(Tabler\App\Http\Controllers\Admin\UserController::class)->group(function () {
    Route::get('user', 'index')->name('user.index');
    Route::post('user', 'store')->name('user.store');
    Route::get('user/create', 'create')->name('user.create');
    Route::get('user/{user}', 'show')->name('user.show');
    Route::post('user/{user}', 'update')->name('user.update');
    Route::delete('user/{user}', 'destroy')->name('user.destroy');
    Route::get('user/{user}/edit', 'edit')->name('user.edit');
});

Route::middleware(['web', 'auth'])->name('tabler.admin.')->prefix('admin/')->controller(Tabler\App\Http\Controllers\Admin\RoleController::class)->group(function () {
    Route::get('role', 'index')->name('role.index');
    Route::post('role', 'store')->name('role.store');
    Route::get('role/create', 'create')->name('role.create');
    Route::get('role/{role}', 'show')->name('role.show');
    Route::post('role/{role}', 'update')->name('role.update');
    Route::delete('role/{role}', 'destroy')->name('role.destroy');
    Route::get('role/{role}/edit', 'edit')->name('role.edit');
});

Route::middleware(['web', 'auth'])->name('tabler.admin.')->prefix('admin/')->controller(Tabler\App\Http\Controllers\Admin\ActivityController::class)->group(function () {
    Route::get('activity', 'index')->name('activity.index');
    Route::post('activity', 'store')->name('activity.store');
    Route::get('activity/create', 'create')->name('activity.create');
    Route::get('activity/{activity}', 'show')->name('activity.show');
    Route::post('activity/{activity}', 'update')->name('activity.update');
    Route::delete('activity/{activity}', 'destroy')->name('activity.destroy');
    Route::get('activity/{activity}/edit', 'edit')->name('activity.edit');
});

Route::middleware(['web', 'auth'])->name('tabler.')->controller(Tabler\App\Http\Controllers\Auth\ProfileController::class)->group(function () {
    Route::get('profile', 'index')->name('profile.index');
    Route::post('profile', 'store')->name('profile.store');
    Route::get('profile/create', 'create')->name('profile.create');
    Route::get('profile/{profile}', 'show')->name('profile.show');
    Route::post('profile/{profile}', 'update')->name('profile.update');
    Route::delete('profile/{profile}', 'destroy')->name('profile.destroy');
    Route::get('profile/{profile}/edit', 'edit')->name('profile.edit');
    Route::put('profile/{profile}/update-password', 'updatePassword')->name('profile.update-password');
});
