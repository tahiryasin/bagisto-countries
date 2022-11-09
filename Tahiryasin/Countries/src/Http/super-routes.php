<?php

use Illuminate\Support\Facades\Route;
use Tahiryasin\Countries\Http\Controllers\Admin\CountryController;
use Tahiryasin\Countries\Http\Controllers\Admin\CountryStateController;

/**
 * Super Countries routes.
 */
Route::group(['middleware' => ['web', 'super-locale']], function () {

    Route::prefix('super')->group(function() {

        Route::group(['middleware' => ['super-admin']], function () {

            Route::prefix('countries')->group(function() {

                Route::get('/', [CountryController::class, 'index'])->defaults('_config', [
                    'view' => 'countries::super.countries.index',
                ])->name('super.countries.index');

                Route::get('create', [CountryController::class, 'create'])->defaults('_config', [
                    'view' => 'countries::super.countries.create',
                ])->name('super.countries.create');

                Route::post('create', [CountryController::class, 'store'])->defaults('_config', [
                    'redirect' => 'super.countries.index',
                ])->name('super.countries.store');

                Route::get('edit/{id}', [CountryController::class, 'edit'])->defaults('_config', [
                    'view' => 'countries::super.countries.edit',
                ])->name('super.countries.edit');

                Route::post('edit/{id}', [CountryController::class, 'update'])->defaults('_config', [
                    'redirect' => 'super.countries.index',
                ])->name('super.countries.update');

                Route::post('/delete/{id}', [CountryController::class, 'delete'])->defaults('_config', [
                    'redirect' => 'super.countries.index',
                ])->name('super.countries.delete');

                Route::post('/massdelete', [CountryController::class, 'massDelete'])->defaults('_config', [
                    'redirect' => 'super.countries.index',
                ])->name('super.countries.mass-delete');
            });

            Route::prefix('states')->group(function() {

                Route::get('/', [CountryStateController::class, 'index'])->defaults('_config', [
                    'view' => 'countries::super.states.index',
                ])->name('super.states.index');

                Route::get('create', [CountryStateController::class, 'create'])->defaults('_config', [
                    'view' => 'countries::super.states.create',
                ])->name('super.states.create');

                Route::post('create', [CountryStateController::class, 'store'])->defaults('_config', [
                    'redirect' => 'super.states.index',
                ])->name('super.states.store');

                Route::get('edit/{id}', [CountryStateController::class, 'edit'])->defaults('_config', [
                    'view' => 'countries::super.states.edit',
                ])->name('super.states.edit');

                Route::post('edit/{id}', [CountryStateController::class, 'update'])->defaults('_config', [
                    'redirect' => 'super.states.index',
                ])->name('super.states.update');

                Route::post('/delete/{id}', [CountryStateController::class, 'delete'])->defaults('_config', [
                    'redirect' => 'super.states.index',
                ])->name('super.states.delete');

                Route::post('/massdelete', [CountryStateController::class, 'massDelete'])->defaults('_config', [
                    'redirect' => 'super.states.index',
                ])->name('super.states.mass-delete');
            });
        });
    });
});
