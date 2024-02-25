<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Employee\Auth\Login;
use App\Http\Middleware\RedirectIfNotSetup;
use App\Http\Livewire\Employee\Personas\Personas;
use App\Http\Livewire\Employee\Auth\ResetPassword;
use App\Http\Livewire\Employee\Ordenes\OrdenLista;
use App\Http\Livewire\Employee\Auth\ForgotPassword;
use App\Http\Livewire\Employee\Personas\PersonaCrear;
use App\Http\Livewire\Employee\Facturas\FacturasCrear;
use App\Http\Livewire\Employee\Facturas\FacturasLista;
use App\Http\Livewire\Employee\Productos\ProductoCrear;
use App\Http\Livewire\Employee\Productos\ProductoLista;
use App\Http\Livewire\Employee\Productos\ProductoEditar;


Route::group([
    'prefix' => config('app.admin_path'),
    'as' => 'employee.',
    'middleware' => RedirectIfNotSetup::class
], function () {
    Route::group(['middleware' => 'guest:employee'], function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
        Route::get('/reset-password/{token}', ResetPassword::class)->name('reset-password');
    });

    Route::group(['middleware' => 'auth:employee'], function () {
        Route::get('/', \App\Http\Livewire\Employee\Dashboard::class)->name('dashboard');
        Route::get('/profile', \App\Http\Livewire\Employee\Profile\ProfileManager::class)->name('profile');
        Route::get('/ordenes', OrdenLista::class)->name('ordenes.lista');
        Route::get('/factura', FacturasLista::class)->name('facturas.lista');
        Route::get('/orders/{order:id}', \App\Http\Livewire\Employee\Order\OrderDetail::class)->name('orders.detail');
        Route::get('/factura/nueva', FacturasCrear::class)->name('factura.crear');
        Route::get('/products', \App\Http\Livewire\Employee\Product\ProductList::class)->name('products.list');
        Route::get('/producto', ProductoLista::class)->name('productos');
        Route::get('/producto/crear', ProductoCrear::class)->name('producto.crear');
        Route::get('/producto/{id}/editar', ProductoEditar::class)->name('producto.editar');
        Route::get('/personas', Personas::class)->name('personas');
        Route::get('/persona/crear', PersonaCrear::class)->name('persona.crear');
        Route::redirect('/settings', '/admin/settings/general');
        Route::get('/settings/general', \App\Http\Livewire\Employee\Settings\GeneralSettingManager::class)->name('settings.general');
        Route::get('/settings/user', \App\Http\Livewire\Employee\User\UserList::class)->name('settings.user.list');
        Route::get('/settings/user/create', \App\Http\Livewire\Employee\User\UserCreate::class)->name('settings.user.create');
        Route::get('/settings/user/{user:id}', \App\Http\Livewire\Employee\User\UserDetail::class)->name('settings.user.detail');
    });
});
