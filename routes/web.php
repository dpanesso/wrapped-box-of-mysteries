<?php

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

Auth::routes(['verify' => true]);

Route::get('/', 'IndexController@index')->name('index');

Route::get('join/{hash}', 'GroupController@join')->name('join');

Route::middleware(['verified'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resources([
        'group' => 'GroupController',
    ]);
    Route::prefix('group')->group(function () {
        Route::get('{group}/invite', 'GroupController@invite')->name('group.invite');
        Route::post('{group}/invite', 'GroupController@sendinvite')->name('group.sendinvite');
    });

    Route::resource('member', 'MemberController')->only([
        'destroy',
        'show',
        'store',
        'update',
    ]);
    Route::prefix('member')->group(function () {
        Route::get('{member}/create', 'MemberController@create_submember')->name('member.create_submember');
        Route::post('{member}/create', 'MemberController@store_submember')->name('member.store_submember');
        Route::post('{member}/wishlist_item', 'MemberController@store_wishlist_item')->name('member.store_wishlist_item');
    });

    Route::resource('wishlistitem', 'WishlistitemController')->only([
        'update'
    ]);
});
