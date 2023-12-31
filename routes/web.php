<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('login2', function () {
    $year = '2023';
    return view('loginv2', compact('year'));
});

Route::group(['middleware' => ['auth']], function () {
    Route::namespace('Profile')->group(function () {
        Route::resource('profile', 'ProfileController');
        Route::get('profile/{id}/edit-password', 'ProfileController@editPassword')->name('profile.editPassword');
        Route::post('profile/{id}/update-password', 'ProfileController@updatePassword')->name('profile.updatePassword');
    });

    //* Master Role
    Route::prefix('master-roles')->namespace('MasterRole')->name('master-role.')->group(function () {
        // Role
        Route::resource('role', 'RoleController');
        Route::prefix('role')->name('role.')->group(function () {
            Route::post('api', 'RoleController@api')->name('api');
            Route::get('{id}/addPermissions', 'RoleController@permission')->name('addPermissions');
            Route::post('storePermissions', 'RoleController@storePermission')->name('storePermissions');
            Route::get('{id}/getPermissions', 'RoleController@getPermissions')->name('getPermissions');
            Route::delete('{name}/destroyPermission', 'RoleController@destroyPermission')->name('destroyPermission');
        });

        // Permission
        Route::resource('permission', 'PermissionController');
        Route::post('permission/api', 'PermissionController@api')->name('permission.api');

        // Pengguna
        Route::resource('pengguna', 'PenggunaController');
    });

    //* Config
    Route::prefix('config')->name('config.')->group(function () {
        // OPD
        Route::resource('opd', 'OPDController');

        // Bidang
        Route::resource('bidang', 'BidangController');

        // Sub Bidang
        Route::resource('sub-bidang', 'SubBidangController');
    });

    Route::get('notulen', 'NotulenController@index')->name('notulen');
    Route::post('notulen/store', 'NotulenController@store')->name('notulen.store');
    Route::get('notulen/{id}', 'NotulenController@show')->name('notulen.show');
    Route::post('notulen/update-status/{id}', 'NotulenController@updateStatus')->name('notulen.updateStatus');
    Route::delete('notulen/{id}', 'NotulenController@destroy')->name('notulen.destroy');
    Route::get('notulen/generate-notulen/{id}', 'NotulenController@generateNotulen')->name('notulen.generateNotulen');
    Route::get('notulen/edit/{id}', 'NotulenController@edit')->name('notulen.edit');
    Route::get('notulen/hapus-foto-rapat/{id}', 'NotulenController@hapusFoto')->name('notulen.hapusFoto');
    Route::post('notulen/update/{id}', 'NotulenController@update')->name('notulen.update');

    //* Helper
    Route::get('get-bidang-by-opd/{id_opd}', 'HelperController@getBidangByOpd')->name('getBidangByOpd');
    Route::get('get-sub-bidang-by-bidang/{id_bidang}', 'HelperController@getSubBidangByBidang')->name('getSubBidangByBidang');
});
