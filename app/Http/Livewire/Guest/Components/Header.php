<?php

namespace App\Http\Livewire\Guest\Components;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Carrito;
use App\Models\Product;
use Livewire\Component;
use App\Models\MenuItem;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Settings\LayoutSetting;

class Header extends Component
{
    public $items = 0;
    public $categorias, $subcategorias,$carrito; 

    protected $listeners = ['refresh'];

    public function mount()
    {
        $this->categorias = Categoria::all();
        $this->subcategorias = Subcategoria::all();
        $this->carrito = Carrito::where('sesion', session()->getId())->get();
        $this->items = $this->carrito->count() ?? 0;
    }

    public function refresh()
    {
        $this->itemsCount = $this->cart->items_sum_quantity ?? 0;
    }

    public function getCustomerProperty(): \App\Models\Customer|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        return \Auth::user();
    }

    public function getCartProperty(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        $cart = $this->customer
            ? Cart::query()->firstOrCreate(['customer_id' => $this->customer->id])
            : Cart::query()->firstOrCreate(['session_id' => session()->getId()]);

        $cart->loadSum('items', 'quantity');

        return $cart;
    }

    public function getLayoutSettingsProperty()
    {
        return app(LayoutSetting::class);
    }

    public function getTopBarMenuProperty()
    {
        if ($this->layout_settings->header_top_bar_enabled && $this->layout_settings->header_top_bar_menu_handle) {
            return $this->menus->where('slug', $this->layout_settings->header_top_bar_menu_handle)->first();
        }
    }

    public function getHeaderMenuProperty()
    {
        if ($this->layout_settings->header_main_menu_handle) {
            return $this->menus->where('slug', $this->layout_settings->header_main_menu_handle)->first();
        }
    }

    public function getMenusProperty()
    {
        $menus = Menu::all();

        $menus->map(function ($menu) {
            $menu->setRelation('menuItems', MenuItem::treeOf(fn($query) => $query->isRoot()->where('menu_id', $menu->id))->get()->toTree());
        });

        return $menus;
    }

    public function render()
    {
        return view('livewire.guest.components.header');
    }
}
