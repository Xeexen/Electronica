<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Customer\OrdenLista;
use App\Http\Middleware\RedirectIfNotSetup;
use App\Http\Livewire\Customer\Order\OrderList;
use App\Http\Livewire\Guest\OrdenDetalleCliente;


Route::group([
    'prefix' => 'account',
    'as' => 'customer.',
    'middleware' => ['auth:customer', RedirectIfNotSetup::class],
], function () {
    Route::get('/profile', \App\Http\Livewire\Customer\Profile\ProfileManager::class)->name('profile');
    Route::get('/orders', OrderList::class)->name('orders.list');
    Route::get('/ordenes', OrdenLista::class)->name('ordenes.lista');
    Route::get('/orders/{order}', \App\Http\Livewire\Customer\Order\OrderDetail::class)->name('orders.detail');
});
